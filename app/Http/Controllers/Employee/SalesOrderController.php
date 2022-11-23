<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\DiscountType;
use App\Models\Patient;
use App\Models\ReferralDoctor;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\SalesOrder;
use App\Models\Test;
use App\Models\TestPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data['test'] = Test::all();
        //$data['package'] = Package::all();
        //dd($data);
        //$data['sales_order'] = session()->has('sales_order')?session()->get('sales_order'):0;
        $data['item_count'] = session()->has('cart') ? count(session()->get('cart')) : 0;
        return view('employee.sales_order.sales_order_create', $data);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function search(Request $request)
    {

        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];

        $data['collections'] = Test::with(['test_group'])->where('name', 'like', '%' . $request->search_text . '%')->paginate(20);
        foreach ($data['collections'] as $key => $item) {
            if ($item->is_package == 1) {
                $item->test_packages = TestPackage::with('test')->where('package_id', $item->id)->get();

            }

        }

        $view = view('employee.sales_order.search_test', $data)->render();
        return response()->json(
            [
                'status' => 'success',
                'view' => $view,
            ]
        );

    }

    public function add_to_order(Request $request)
    {

        //add cart to session
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [];
        }

        $data = Test::where('id', $request->id)->first();

        $cart[$data->id] = [
            'id' => $data->id,
            'name' => $data->name,
            'qty' => 1,
            'rate' => $data->amount,
            'discount_percentage' => 0,
            'discount' => 0,
            'discounted_amount' => 0,
            'amount' => $data->amount,
            'test_date' => date('Y-m-d'),
            'report_date' => $data->test_duration == 0 ? date('Y-m-d') : date('Y-m-d', strtotime('+' . $data->test_duration . ' days')),
            'test_duration' => $data->test_duration,
            'test_status' => 'pending',
            'image' => $data->image,
        ];
        //dd($cart);
        session()->put('cart', $cart);
        // session()->put('sales_order', $sales_order);
        return response()->json(
            [
                'status' => 'success',
                'item_count' => count($cart),
                'message' => 'Test added to order successfully',
            ]
        );

    }

    public function delete_from_order(Request $request)
    {
        //delete cart from session
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }
        unset($cart[$request->id]);
        session()->put('cart', $cart);
        return response()->json(
            [
                'status' => 'success',
                'item_count' => count($cart),
                'message' => 'Test deleted from order successfully',
            ]
        );
    }
    public function delete_from_order_preview($id)
    {

        //delete cart from session
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back();

    }
    //sales_order_preview
    public function sales_order_preview(Request $request)
    {

        // return response(view('employee.sales_order.sales_order_preview',$data),200, ['Content-Type' => 'application/json']);
        return view('employee.sales_order.sales_order_preview', $this->prepare_cart());
    }

    public function quick_view(Request $request)
    {
        $html = view('employee.sales_order.quick_view', $this->prepare_cart())->render();
        return response()->json(['html' => $html]);
    }
    private function prepare_cart()
    {
        $sales_order = session()->has('sales_order') ? session()->get('sales_order') : [];
        if (!$sales_order) {
            $sales_order = [];
        }

        //$Ids=implode(', ', $Ids);
        // dd($sales_order);
        $patient_id = !empty($sales_order['patient_id']) ? $sales_order['patient_id'] : 0;
        $sales_order['item_count'] = 0;
        $sales_order['patient'] = $patient_id != 0 ? Patient::find($patient_id) : [];
        $sales_order['associate_id'] = $patient_id != 0 ? $sales_order['patient']['associate_id'] : 0;
        $sales_order['associate'] = $sales_order['associate_id'] != 0 ? Associate::find($sales_order['associate_id']) : [];
        $sales_order['referral_doctor_id'] = $patient_id != 0 ? $sales_order['patient']['referral_doctor_id'] : 0;
        $sales_order['referral_doctor'] = $sales_order['referral_doctor_id'] != 0 ? ReferralDoctor::find($sales_order['referral_doctor_id']) : [];

        $discount_type_id = !empty($sales_order['discount_type_id']) ? $sales_order['discount_type_id'] : 0;

        $sales_order['discount_type_id'] = $discount_type_id;
        $sales_order['discount_type'] = $discount_type_id != 0 ? DiscountType::find($discount_type_id) : [];
        $sales_order['discount_amount'] = 0;
        $sales_order['discounted_amount'] = 0;
        $sales_order['total_amount'] = 0;
        //======= cart loading =======//

        $cart = session()->has('cart') ? session()->get('cart') : [];

        $total_amount = 0;
        //dd($cart);
        $Ids = array_keys($cart);

        $data['discount_types'] = DiscountType::all();
        $collections = Test::whereIn('id', $Ids)->get();
        //map collections with cart

        foreach ($collections as $key => $item) {
            //print_r($data['cart'][$item->id]);

            // $collections[$key]['test'] = $item->toarray();
            $collections[$key]['test_id'] = $item->id;
            $collections[$key]['qty'] = 1;
            $collections[$key]['test_date'] = !empty($cart[$item->id]['test_date']) ? $cart[$item->id]['test_date'] : date('Y-m-d');
            $collections[$key]['report_date'] = !empty($cart[$item->id]['report_date']) ? $cart[$item->id]['report_date'] : date('Y-m-d');
            $collections[$key]['discount_amount'] = 0;
            if ($item->is_package == 1) {
                $item->test_packages = TestPackage::with('test')->where('package_id', $item->id)->get();
            }

            if (!empty($sales_order['discount_type'])) {
                //dd($sales_order['discount_type']->discount_for );
                if ($sales_order['discount_type']->discount_for == 'test') {
                    //dd($sales_order['discount_type']);
                    $collections[$key]['discount_percentage'] = $sales_order['discount_type']->discount;
                    $collections[$key]['discount_amount'] = $sales_order['discount_type']->discount * $collections[$key]['amount'] / 100;
                    $collections[$key]['discounted_amount'] = $collections[$key]['amount'] - $collections[$key]['discount_amount'];
                    $collections[$key]['item_amount'] = $collections[$key]['discounted_amount'];

                } else {

                    $collections[$key]['discount_percentage'] = 0;
                    $collections[$key]['discount_amount'] = 0;
                    $collections[$key]['discounted_amount'] = $collections[$key]['amount'] - $collections[$key]['discount_amount'];
                    $collections[$key]['item_amount'] = $collections[$key]['discounted_amount'];
                }
            } else {
                $collections[$key]['discount_percentage'] = 0;
                $collections[$key]['discount_amount'] = 0;
                $collections[$key]['discounted_amount'] = $collections[$key]['amount'];
                $collections[$key]['item_amount'] = $collections[$key]['discounted_amount'];
            }
            $sales_order['item_count']++;
            // dd($collections[$key]['discount_amount']);
            $sales_order['discount_amount'] += $collections[$key]['discount_amount'];
            $sales_order['discounted_amount'] += $collections[$key]['discounted_amount'];
            $sales_order['total_amount'] += $collections[$key]['amount'];
            //dd($sales_order);
        }

        if (!empty($sales_order['discount_type'])) {
            //dd($sales_order['discount_type']->discount_for );
            if ($sales_order['discount_type']->discount_for == 'cart') {
                //dd($sales_order['discount_type']);
                $sales_order['discount_amount'] = $sales_order['discount_type']->discount * $sales_order['total_amount'] / 100;
                $sales_order['discounted_amount'] = $sales_order['total_amount'] - $sales_order['discount_amount'];
            }
        }

        //dd($collections);
        session()->put('sales_order', $sales_order);
        //session()->put('cart', $collections) ;
        $data['sales_order'] = $sales_order;
        $data['collections'] = $collections;
//dd($data);
        $data['cart'] = session()->has('cart') ? session()->get('cart') : [];
        return $data;
    }
    public function change_test_date(Request $request)
    {

        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }
        $cart[$request->test_id]['test_date'] = $request->test_date;
        $cart[$request->test_id]['report_date'] = $request->test_duration == 0 ? $request->test_date : date('Y-m-d', strtotime($request->test_date . '+' . $request->test_duration . ' days'));
        // dd($cart[$request->test_id]);
        session()->put('cart', $cart);
        return response()->json(
            [
                'status' => 'success',
                'report_date' => $cart[$request->test_id]['report_date'],
                'message' => 'Test date changed successfully',
            ]
        );
    }

    public function sales_order_process(Request $request)
    {
        $sales_order = new SalesOrder();
        $sales_order->customer_name = $request->customer_name;
        $sales_order->customer_phone = $request->customer_phone;
        $sales_order->customer_address = $request->customer_address;
        $sales_order->customer_email = $request->customer_email;
        $sales_order->customer_note = $request->customer_note;
        $sales_order->save();
        $cart = session()->get('cart');
        foreach ($cart as $item) {
            $sales_order->tests()->attach($item['id'], ['qty' => $item['qty'], 'amount' => $item['amount']]);
        }
        session()->forget('cart');
        return redirect()->route('employee.sales_order.index')->with('success', 'Sales order created successfully');
    }
    public function discount_apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ]
            );
        }

        // $cart = session()->get('cart');
        // if (!$cart) {
        //     $cart = [];
        // }
        $sales_order = session()->get('sales_order');
        if (!$sales_order) {
            $sales_order = [];
        }
        $discount_type = DiscountType::find($request->discount_type_id); //get discount type
        $sales_order['discount_type_id'] = $request->discount_type_id; //set discount type id in session
        $sales_order['discount_type'] = $discount_type;
        //dd($sales_order);

        session()->put('sales_order', $sales_order);
        //dd($sales_order);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Test discount applied successfully',
            ]
        );
    }

    public function generate_invoice()
    {
        $sid = 0;
        DB::transaction(function () {

            $sales_order = session()->has('sales_order') ? session()->get('sales_order') : [];
            $cart = session()->has('cart') ? session()->get('cart') : [];
            //dd($cart);
            if (count($sales_order) == 0) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'No sales order found',
                    ]
                );
            }
            if (count($cart) == 0) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'No test found',
                    ]
                );
            }
            $user = Auth::guard('employee')->user();

            $data = new SalesInvoice();
            $data->invoice_no = $this->generate_invoice_no();

            $data->invoice_date = date('Y-m-d');
            $data->item_count = $sales_order['item_count'];
            $data->patient_id = $sales_order['patient_id'];
            // $data->patient=json_encode($sales_order['patient'],true);
            $data->associate_id = $sales_order['associate_id'];
            // $data->associate=json_encode($sales_order['associate'],true);
            $data->referral_doctor_id = $sales_order['referral_doctor_id'];
            // $data->referral_doctor=json_encode($sales_order['referral_doctor'],true);
            $data->discount_type_id = $sales_order['discount_type_id'];
            // $data->discount_type=json_encode($sales_order['discount_type'],true);
            $data->item_total = $sales_order['total_amount'];
            $data->discount_amount = $sales_order['discount_amount'];
            $data->discounted_amount = $sales_order['discounted_amount'];
            $data->total_amount = $sales_order['discounted_amount'];
            $data->paid_amount = 0;
            $data->due_amount = $data->total_amount - $data->paid_amount;
            $data->payment_mode_id = 0;
            $data->collection_centre_id = $user->collection_centre_id;
            $data->lab_centre_id = $user->lab_centre_id;
            $data->created_by = $user->id;

            $data->save();

            $sales_invoice_id = $data->id;
            $sid = $data->id;

            foreach ($cart as $item) {
                $test = Test::find($item['id']);

                if (!empty($sales_order['discount_type'])) {

                    //dd($sales_order['discount_type']->discount_for );
                    if ($sales_order['discount_type']->discount_for == 'test') {
                        $item['discount_percentage'] = $sales_order['discount_type']->discount;
                        $item['discount'] = $test->amount * $sales_order['discount_type']->discount / 100;
                        $item['amount'] = $test->amount - $item['discount'];

                    } else {
                        $item['discount_percentage'] = 0;
                        $item['discount'] = 0;
                        $item['amount'] = $test->amount - $item['discount'];
                    }
                } else {
                    $item['discount_percentage'] = 0;
                    $item['discount'] = 0;
                    $item['amount'] = $test->amount - $item['discount'];
                }

                $data = new SalesInvoiceItem();
                $data->sales_invoice_id = $sales_invoice_id;
                $data->test_id = $item['id'];
                $data->is_package = $test->is_package;
                $data->test_cost = $test->amount;
                $data->discount_percentage = $item['discount_percentage'];
                $data->discount = $item['discount'];
                $data->amount = $item['amount'];
                $data->amount_weightage = ($item['amount'] / $sales_order['discounted_amount']) * 100;
                $data->test_date = $item['test_date'];
                $data->report_date = $item['report_date'];
                $data->test_status_id = 1;
                $data->created_by = $user->id;
                $log = json_encode([
                    'test_status' => 'Invoiced',
                    'created_by' => $user->name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $data->test_log = $log;

                $data->save();

            }

        });
        session()->forget('cart');
        session()->forget('sales_order');
        return response()->json(
            [
                'status' => 'success',
                'id' => $sid,
                'message' => 'Sales Invoice created successfully',
            ]
        );
        //return view('employee.sales_order.pay_now', $data);

    }
    public function generate_invoice_no()
    {
        $user = Auth::guard('employee')->user();

        $invoice_no = SalesInvoice::where('lab_centre_id', $user->lab_centre_id)
            ->where('invoice_date', date('Y-m-d'))->count(); //get count of sales invoice of today
        if ($invoice_no) {
            $invoice_no = $invoice_no + 1;
            $invoice_no = 'INV-' . date('ymd') . '-' . $user->lab_centre_id . '-' . $invoice_no;
        } else {
            $invoice_no = 'INV-' . date('ymd') . '-' . $user->lab_centre_id . '-1';
        }
        return $invoice_no;
    }

}
