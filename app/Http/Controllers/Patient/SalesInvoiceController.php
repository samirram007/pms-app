<?php

namespace App\Http\Controllers\Patient;

use App\Models\Patient;
use App\Models\LabCentre;
use App\Models\SalesReturn;
use App\Models\SalesInvoice;
use App\Models\SalesPayback;
use Illuminate\Http\Request;
use App\Models\SalesInvoiceItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SalesInvoicePayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
            'page_route' => route('patient.sales_invoice.index'),
            'create_route' => route('patient.sales_invoice.create'),

        ];
        $this->user = Auth::guard('patient')->user();
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['title'] = 'Collection Report';
        $user=Patient::find(auth()->user()->id);
       // dd($user);
        $data['lab_centres']=LabCentre::where('id',$user->lab_centre_id)->get();

            $sales_invoices = SalesInvoice::where('patient_id', Auth::guard('patient')->user()->id)->OrderBy('created_at','desc')->get();
            // dd($sales_invoices);
            // $data['collections'] = $sales_invoices::OrderBy('created_at','desc')->get();
             $data['collections']=$sales_invoices;
             $data['header_data']=$this->header_data;
            return view('patient.sales_invoice.sales_invoice_index', $data);
    }

    public function sales_invoice_search(Request $request)
    {

        $data['title'] = 'Booking Report';

        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;
//dd(Auth::guard('patient')->user()->id);
        // $data['lab_centre'] = LabCentre::find($request->lab_centre_id);
        $data['collections'] = SalesInvoice::with(['created_by_user', 'patient'])
       -> where('patient_id', Auth::guard('patient')->user()->id)
            ->whereBetween(DB::raw("DATE_FORMAT(invoice_date,'%Y-%m-%d')"), [$request->from_date, $request->to_date])
            ->OrderBy('created_at', 'desc')->get();
        $response['body'] = view('patient.sales_invoice.sales_invoice_index_body', $data)->render();
      //dd($data['collections']);
        //dd($data['lab_centre']);
        return response()->json($response);
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
        $pdf = Pdf::loadView('patient.sales_invoice.money_receipt', $data, [], [
            'format' => 'A5-L',
        ]);
        $pdf->SetProtection(['print', 'print-highres'], '', 'pass');
        return $pdf->stream('money_receipt.pdf');
        //return $pdf->download('money_receipt.pdf');
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');

    }

}
