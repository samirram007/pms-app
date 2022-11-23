<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LabCentre;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceItem;
use App\Models\SalesInvoicePayment;
use App\Models\SalesPayback;
use App\Models\SalesReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
   public function collection_report()
   {
    $data['title'] = 'Collection Report';
    $user=Employee::find(auth()->user()->id);
   // dd($user);
    $data['lab_centres']=LabCentre::where('id',$user->lab_centre_id)->get();
        return view('employee.report.collection_report',$data);
   }
   public function collection_search(Request $request)
   {
    $data['title'] = 'Collection Report';

    $data['from_date']=$request->from_date;
    $data['to_date']=$request->to_date;

    $data['lab_centre']=LabCentre::find($request->lab_centre_id);

    $sales_payment_invoice_ids=SalesInvoicePayment::where('lab_centre_id',$request->lab_centre_id)
                                ->whereBetween(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])
                                ->distinct()
                                ->get(['sales_invoice_id']);
    $sales_return_invoice_ids=SalesReturn::where('lab_centre_id',$request->lab_centre_id)
                                ->whereBetween(DB::raw("DATE_FORMAT(sales_return_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])
                                ->distinct()
                                ->get(['sales_invoice_id']);
    $sales_payback_invoice_ids=SalesPayback::where('lab_centre_id',$request->lab_centre_id)
                                ->whereBetween(DB::raw("DATE_FORMAT(sales_payback_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])
                                ->distinct()
                                ->get(['sales_invoice_id']);
    $sales_invoice_ids=array_merge($sales_payment_invoice_ids->toArray(),$sales_return_invoice_ids->toArray(),$sales_payback_invoice_ids->toArray());
    $sales_invoice_ids=array_unique($sales_invoice_ids,SORT_REGULAR);
    asort($sales_invoice_ids);
    // uksort($sales_invoice_ids,"my_sort");
    $sales_invoices=SalesInvoice::whereIn('id',$sales_invoice_ids)->get();
    $collection_report=[];
    $total_collection_report=[
        'item_total'=>0,
        'discount_amount'=>0,
        'total_amount'=>0,
        'sales_invoice_advance_payments'=>0,
        'sales_invoice_due_payments'=>0,
        'sales_invoice_payments'=>0,
        'sales_return'=>0,
        'sales_payback'=>0,
        'total_collection'=>0,
        ];
    foreach($sales_invoices as $key=>$sales_invoice)
    {
        // $collection_report[$key]['payment_mode']=$sales_invoice->payment_mode();
        // $collection_report[$key]['lab_centre']=$sales_invoice->lab_centre();
        // $collection_report[$key]['customer']=$sales_invoice->customer();
        $collection_report[$key]['invoice_no']=$sales_invoice->invoice_no;
        $collection_report[$key]['invoice_date']=$sales_invoice->invoice_date;
        $collection_report[$key]['item_total']=$sales_invoice->item_total;
        $collection_report[$key]['total_amount']=$sales_invoice->total_amount;

        $collection_report[$key]['invoice_total']=$sales_invoice->item_total;
        $collection_report[$key]['discount_amount']=$sales_invoice->discount_amount;
        $collection_report[$key]['net_payble']=$sales_invoice->total_amount;

        $test_row=SalesInvoiceItem::where('sales_invoice_id',$sales_invoice->id)
                    ->orderBy('test_date', 'desc')->first();
        $collection_report[$key]['sales_invoice_advance_payments']=SalesInvoicePayment::where('lab_centre_id',$request->lab_centre_id)
                                                                ->where('sales_invoice_id',$sales_invoice->id)
                                                                ->where(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),'<',$test_row->test_date)
                                                                ->whereBetween(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])->sum('amount');
        $collection_report[$key]['sales_invoice_due_payments']=SalesInvoicePayment::where('lab_centre_id',$request->lab_centre_id)
                                                                ->where('sales_invoice_id',$sales_invoice->id)
                                                                ->where(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),'>',$sales_invoice->invoice_date)
                                                                ->whereBetween(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])->sum('amount');

        $collection_report[$key]['sales_invoice_payments']=SalesInvoicePayment::where('lab_centre_id',$request->lab_centre_id)
                                                                ->where('sales_invoice_id',$sales_invoice->id)
                                                                ->where('payment_date',$sales_invoice->invoice_date)
                                                                ->where(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),$test_row->test_date)
                                                                ->whereBetween(DB::raw("DATE_FORMAT(payment_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])->sum('amount');

        $collection_report[$key]['sales_return']=SalesReturn::where('lab_centre_id',$request->lab_centre_id)
        ->where('sales_invoice_id',$sales_invoice->id)
        ->whereBetween(DB::raw("DATE_FORMAT(sales_return_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])->sum('amount');

        $collection_report[$key]['sales_payback']=SalesPayback::where('lab_centre_id',$request->lab_centre_id)
        ->where('sales_invoice_id',$sales_invoice->id)
        ->whereBetween(DB::raw("DATE_FORMAT(sales_payback_date,'%Y-%m-%d')"),[$request->from_date,$request->to_date])->sum('amount');
        $collection_report[$key]['total_collection']=$collection_report[$key]['sales_invoice_payments']
                                                    + $collection_report[$key]['sales_invoice_advance_payments']
                                                    + $collection_report[$key]['sales_invoice_due_payments']
                                                    -$collection_report[$key]['sales_payback'];

        $total_collection_report['item_total']+=$collection_report[$key]['item_total'];
        $total_collection_report['discount_amount']+=$collection_report[$key]['discount_amount'];
        $total_collection_report['total_amount']+=$collection_report[$key]['total_amount'];
        $total_collection_report['sales_invoice_advance_payments']+=$collection_report[$key]['sales_invoice_advance_payments'];
        $total_collection_report['sales_invoice_due_payments']+=$collection_report[$key]['sales_invoice_due_payments'];
        $total_collection_report['sales_invoice_payments']+=$collection_report[$key]['sales_invoice_payments'];
        $total_collection_report['sales_return']+=$collection_report[$key]['sales_return'];
        $total_collection_report['sales_payback']+=$collection_report[$key]['sales_payback'];
        $total_collection_report['total_collection']+=$collection_report[$key]['total_collection'];

    }


    $data['collection_report']  = $collection_report;
    $data['total_collection_report']  = $total_collection_report;
                  //             dd($collection_report);
    $response['body']= view('employee.report.collection_report_body',$data)->render();
    //dd($data['lab_centre']);
        return response()->json($response);
   }

   function my_sort($a,$b)
    {
    if ($a==$b) return 0;
    return ($a<$b)?-1:1;
    }
}
