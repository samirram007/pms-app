<?php

namespace App\Http\Controllers\Patient;

use App\Models\TestQueue;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestReportController extends Controller
{
    public function test_report(Request $request)
    {

         $booking_id=$request->param;
         // dd($booking_id);
            $data['title'] = 'Test Report';
            $data['booking']=SalesInvoice::where('id',$booking_id)->first();

            $data['test_report']= TestQueue::with('patient','sales_invoice')->where('sales_invoice_id',$booking_id)->get();
// dd($data);
                $html= view('patient.sales_invoice.report_index',$data)->render();
                return response()->json(['message' => '','html'=>$html], 200);


    }
}
