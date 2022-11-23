<?php

namespace App\Http\Controllers\Employee;

use App\Models\User;
use App\Models\Employee;
use App\Models\LabCentre;
use App\Models\PaymentMode;
use App\Models\SalesReturn;
use App\Models\SalesInvoice;
use App\Models\SalesPayback;
use Illuminate\Http\Request;
use App\Models\SalesInvoiceItem;
use Illuminate\Support\Facades\DB;
use App\Models\SalesInvoicePayment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class SalesInvoiceController extends Controller
{
    protected $header_data;
    protected $user;
    public function __construct()
    {
        $this->header_data = [
            'title' => 'Booking[Sales Invoice] List',
            'page_name' => 'Sales Invoice',
            'page_route' => route('employee.sales_invoice.index'),
            'create_route' => route('employee.sales_invoice.create'),

        ];
        $this->user = Auth::guard('employee')->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['title'] = 'Collection Report';
        $user=Employee::find(auth()->user()->id);
       // dd($user);
        $data['lab_centres']=LabCentre::where('id',$user->lab_centre_id)->get();

            $sales_invoices = SalesInvoice::where('created_by', Auth::guard('employee')->user()->id)->OrderBy('created_at','desc')->get();
            // dd($sales_invoices);
            // $data['collections'] = $sales_invoices::OrderBy('created_at','desc')->get();
             $data['collections']=$sales_invoices;
             $data['header_data']=$this->header_data;
            return view('employee.sales_invoice.sales_invoice_index', $data);
    }

    public function sales_invoice_search(Request $request)
    {
        $data['title'] = 'Booking Report';

        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;

        $data['lab_centre'] = LabCentre::find($request->lab_centre_id);
        $data['collections'] = SalesInvoice::with(['created_by_user', 'patient'])->where('lab_centre_id', $request->lab_centre_id)
       -> where('created_by', Auth::guard('employee')->user()->id)
            ->whereBetween(DB::raw("DATE_FORMAT(invoice_date,'%Y-%m-%d')"), [$request->from_date, $request->to_date])
            ->OrderBy('created_at', 'desc')->get();
        $response['body'] = view('employee.sales_invoice.sales_invoice_index_body', $data)->render();
        //dd($data['lab_centre']);
        return response()->json($response);
    }

    public function pay_now($id)
    {

        $data['sales_invoice'] = SalesInvoice::where('id', $id)->first();
        $data['sales_invoice_items'] = SalesInvoiceItem::where('sales_invoice_id', $id)->get();
        $data['sales_invoice_payments'] = SalesInvoicePayment::where('sales_invoice_id', $id)->get();
        $data['sales_return'] = SalesReturn::where('sales_invoice_id', $id)->get();
        $data['sales_payback'] = SalesPayback::where('sales_invoice_id', $id)->get();
        $data['due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount') + $data['sales_payback']->sum('amount');
        $data['current_due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount');

        $data['payment_modes'] = PaymentMode::all();
        return view('employee.sales_invoice.pay_now', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function init_sales_return($id)
    {

        $user = Auth::guard('employee')->user();
        $sales_invoice = SalesInvoice::find($id);

        $sales_invoice_items = SalesInvoiceItem::where('sales_invoice_id', $id)->where('is_cancelled', 1)->get();
        $sales_invoice_item_ids = [];
        $returnable_amount = 0;
        foreach ($sales_invoice_items as $key => $sales_invoice_item) {
            $sales_invoice_item_ids[$key] = $sales_invoice_item->test_id;
            $returnable_amount += $sales_invoice_item->amount;
        }
        $existing_returns = SalesReturn::where('sales_invoice_id', $id)->get();
        // dd(count($existing_returns));
        $sales_return = count($existing_returns) != 0 ? $existing_returns[0] : new SalesReturn();

        $sales_return->sales_invoice_id = $id;
        $sales_return->sales_return_date = now();
        $sales_return->sales_return_number = $this->generate_return_no();
        $sales_return->amount = $returnable_amount;
        $sales_return->sales_invoice_item_ids = json_encode($sales_invoice_item_ids); //$request->sales_invoice_item_ids;
        $sales_return->sales_return_status = 'return';
        $sales_return->lab_centre_id = $sales_invoice->lab_centre_id;
        $sales_return->collection_centre_id = $sales_invoice->collection_centre_id;
        $sales_return->created_by = $user->id;
        $sales_return->updated_by = $user->id;
        $sales_return->save();
        $notification = array(
            'message' => 'Sales Return Added Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
    public function payback(Request $request, $id)
    {
        $user = Auth::guard('employee')->user();
        $sales_invoice = SalesInvoice::find($id);
        $existing_payback = SalesPayback::where('sales_invoice_id', $id)->get();

        $sales_payback = count($existing_payback) != 0 ? $existing_payback[0] : new SalesPayback();
        //  dd($sales_payback);
        $sales_payback->sales_invoice_id = $id;
        $sales_payback->sales_payback_date = now();
        $sales_payback->sales_payback_number = $this->generate_payback_no();
        $sales_payback->amount = $request->payback_amount;
        $sales_payback->sales_payback_status = 'paid';
        $sales_payback->lab_centre_id = $sales_invoice->lab_centre_id;
        $sales_payback->collection_centre_id = $sales_invoice->collection_centre_id;
        $sales_payback->created_by = $user->id;
        $sales_payback->updated_by = $user->id;
        $sales_payback->save();
        $notification = array(
            'message' => 'Payback Initiated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }

    public function pay(Request $request)
    {

        DB::transaction(function ()
             use ($request) {

                $validator = Validator::make($request->all(), [
                    'sales_invoice_id' => 'required',
                    'payment_mode_id' => 'required',
                    'amount' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        [

                            'status' => 'error',
                            'message' => $validator->errors()->first(),
                        ]
                    );
                }

                $user = Auth::guard('employee')->user();

                $sales_invoice = SalesInvoice::find($request->sales_invoice_id);

                $data = new SalesInvoicePayment();
                $data->payment_no = $this->generate_payment_no();
                $data->payment_date = date('Y-m-d');
                $data->sales_invoice_id = $sales_invoice->id;
                $data->patient_id = $sales_invoice->patient_id;
                $data->payment_mode_id = $request->payment_mode_id;
                $data->amount = $request->amount;
                $data->payment_mode_id = $request->payment_mode_id;
                $data->is_confirm = 1;
                $data->payer_name = $request->payer_name;
                $data->card_number = $request->card_number;
                $data->tid = $request->tid;
                $data->transaction_number = $request->transaction_number;
                $data->collection_centre_id = $user->collection_centre_id;
                $data->lab_centre_id = $user->lab_centre_id;
                $data->created_by = $user->id;

                $data->save();
                // dd($data);

            });
        // $notification=array(
        //     'success'=>true,
        //     'message'=>'Payment Added Successfully',
        //     'alert-type'=>'info'
        // );
        // return redirect()->back()->with($notification);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Payment Added Successfully',
            ]
        );
        //return view('employee.sales_order.pay_now', $data);

    }
    public function generate_payment_no()
    {
        $user = Auth::guard('employee')->user();

        $payment_no = SalesInvoicePayment::where('lab_centre_id', $user->lab_centre_id)
            ->where('payment_date', date('Y-m-d'))->count(); //get count of sales invoice of today
        if ($payment_no) {
            $payment_no = $payment_no + 1;
            $payment_no = 'PYM-' . date('ymd') . '-' . $user->lab_centre_id . '-' . $payment_no;
        } else {
            $payment_no = 'PYM-' . date('ymd') . '-' . $user->lab_centre_id . '-1';
        }
        return $payment_no;
    }

    public function generate_return_no()
    {
        $user = Auth::guard('employee')->user();

        $return_no = SalesReturn::where('lab_centre_id', $user->lab_centre_id)
            ->where('sales_return_date', date('Y-m-d'))->count(); //get count of sales invoice of today
        if ($return_no) {
            $return_no = $return_no + 1;
            $return_no = 'RTN-' . date('ymd') . '-' . $user->lab_centre_id . '-' . $return_no;
        } else {
            $return_no = 'RTN-' . date('ymd') . '-' . $user->lab_centre_id . '-1';
        }
        return $return_no;
    }
    public function generate_payback_no()
    {
        $user = Auth::guard('employee')->user();

        $payback_no = SalesPayback::where('lab_centre_id', $user->lab_centre_id)
            ->where('sales_payback_date', date('Y-m-d'))->count(); //get count of sales invoice of today
        if ($payback_no) {
            $payback_no = $payback_no + 1;
            $payback_no = 'PBK-' . date('ymd') . '-' . $user->lab_centre_id . '-' . $payback_no;
        } else {
            $payback_no = 'PBK-' . date('ymd') . '-' . $user->lab_centre_id . '-1';
        }
        return $payback_no;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //sales invoice edit
        $id = Crypt::decryptString($id);
        $data['sales_invoice'] = SalesInvoice::where('id', $id)->first();
        $data['sales_invoice_items'] = SalesInvoiceItem::where('sales_invoice_id', $id)->get();
        $data['sales_invoice_payments'] = SalesInvoicePayment::where('sales_invoice_id', $id)->get();
        $data['sales_return'] = SalesReturn::where('sales_invoice_id', $id)->get();
        $data['sales_payback'] = SalesPayback::where('sales_invoice_id', $id)->get();
        $data['due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount') + $data['sales_payback']->sum('amount');
        $data['current_due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount');
        // dd($data['due_amount']);
        //dd($data['collections']);
        //dd($data);
        return view('employee.sales_invoice.sales_invoice_edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //test_delete
    public function test_delete($id)
    {
        //
        $item = SalesInvoiceItem::where('id', $id)->first();
        $item->is_cancelled = 1;
        $item->save();
        return redirect()->back();
    }

    public function money_receipt($id)
    {
        $id = Crypt::decryptString($id);
        // Crypt::decryptString($encrypted)

        $data['sales_invoice'] = SalesInvoice::where('id', $id)->first();

        $data['sales_invoice_items'] = SalesInvoiceItem::where('sales_invoice_id', $id)->get();
        $data['sales_invoice_payments'] = SalesInvoicePayment::where('sales_invoice_id', $id)->get();

        $data['sales_return'] = SalesReturn::where('sales_invoice_id', $id)->get();
        $data['sales_payback'] = SalesPayback::where('sales_invoice_id', $id)->get();
        $data['due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount') + $data['sales_payback']->sum('amount');
        $data['current_due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount');
        //dd($data['sales_invoice']);
        $pdf = Pdf::loadView('employee.sales_invoice.money_receipt', $data, [], [
            'format' => 'A5-L',
        ]);
        $pdf->SetProtection(['print', 'print-highres'], '', 'pass');
        return $pdf->stream('money_receipt.pdf');
        //return $pdf->download('money_receipt.pdf');
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');

    }
}
