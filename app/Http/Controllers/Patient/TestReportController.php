<?php

namespace App\Http\Controllers\Patient;

use App\Models\TestQueue;
use App\Models\SalesReturn;
use App\Models\SalesInvoice;
use App\Models\SalesPayback;
use Illuminate\Http\Request;
use App\Models\SalesInvoiceItem;
use App\Models\SalesInvoicePayment;
use App\Http\Controllers\Controller;

class TestReportController extends Controller
{
    public function test_report(Request $request)
    {

         $booking_id=$request->param;
         // dd($booking_id);
            $data['title'] = 'Test Report';
            $data['booking']=SalesInvoice::where('id',$booking_id)->first();
            $id=$booking_id;
            $data['sales_invoice']= $data['booking'];
            $data['sales_invoice_items'] = SalesInvoiceItem::where('sales_invoice_id', $id)->get();
        $data['sales_invoice_payments'] = SalesInvoicePayment::where('sales_invoice_id', $id)->get();

        $data['sales_return'] = SalesReturn::where('sales_invoice_id', $id)->get();
        $data['sales_payback'] = SalesPayback::where('sales_invoice_id', $id)->get();
        $data['due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount') + $data['sales_payback']->sum('amount');
        $data['current_due_amount'] = $data['sales_invoice']->total_amount - $data['sales_invoice_payments']->sum('amount') - $data['sales_return']->sum('amount');

        // if($data['current_due_amount']==0){
                $data['test_report']= TestQueue::with('patient','sales_invoice')->where('sales_invoice_id',$booking_id)->get();

                        $html= view('patient.sales_invoice.report_index',$data)->render();
                        return response()->json(['message' => '','html'=>$html], 200);
        // }
        // else{
        //     return response()->json(['message' => '','html'=>'<h1>Payment Pending</h1>'], 200);
        // }



    }
}
