<?php

namespace App\Http\Controllers\Employee;

use App\Models\Test;
use App\Models\Employee;
use App\Models\LabCentre;
use App\Models\TestQueue;
use App\Models\TestPackage;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use App\Models\SalesInvoiceItem;
use App\Models\TestReportConfig;
use Illuminate\Support\Facades\DB;
use App\Models\SalesInvoicePayment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class TestQueueController extends Controller
{
    protected $header_data;
    protected $user;
    protected $test_status=['pending','inprogress','completed','delivered','cancelled'];
    protected $components = [

        'content'=>'content',

        'section'=>'section',
        'table'=>'table',
        'div'=>'div',
        'span'=>'span',
        'p'=>'p',
        'input'=>'input',
        'test'=>'test',
        'label'=>'label',
        'textarea' => 'textarea',
        'select' => 'select',
    ];
    public function __construct()
    {
        $this->header_data = [
            'title' => 'Test Queue',
            'page_name' => 'Test Queue',
            'page_route' => route('employee.test_queue.index'),
            // 'create_route' => route('employee.test_queue.create'),

        ];
        //$this->user = Auth::guard('employee')->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['header_data'] = $this->header_data;
        $user = Employee::find(Auth::guard('employee')->user()->id);
$data['test_status']=$this->test_status;
        $data['lab_centres'] = LabCentre::where('id', $user->lab_centre_id)->get();
        $data['collections'] = TestQueue::all();
        return view('employee.test_queue.index', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
//        $data['header_data'] = $this->header_data;

        // DB::transaction(function () {
            $user = Employee::find(Auth::guard('employee')->user()->id);
            $data['lab_centres'] = LabCentre::where('id', $user->lab_centre_id)->get();
            $invoice=SalesInvoice::where('lab_centre_id', $user->lab_centre_id)->get();
            //sales_invoice_ exists in sales_invoice_payments but not in test_queues
            $test_queue = TestQueue::where('lab_centre_id', $user->lab_centre_id)->distinct()->get('sales_invoice_id');
            // dd($test_queue);
            $paid_invoice = SalesInvoicePayment::where('lab_centre_id', $user->lab_centre_id)
            ->select('sales_invoice_id')
            ->groupBy('sales_invoice_id')
            ->get();
            //dd($test_queue);
            $test_queue_array = json_decode(json_encode($test_queue), true);
             foreach($paid_invoice as $key=> $paid_inv){
                if(in_array($paid_inv->sales_invoice_id, array_column( $test_queue_array,'sales_invoice_id'))){
                    unset($paid_invoice[$key]);
                }
            }

            //insert into test_queues from sales_invoice_items
            $test_items = SalesInvoiceItem::with('sales_invoice','test')->whereIn('sales_invoice_id', $paid_invoice)->get();
           // dd($test_items);
            foreach($test_items as $test_item){

                 if($test_item->test->is_package == 1){
                    $tests=TestPackage::where('package_id', $test_item->test->id)->get();
                    foreach($tests as $test){
                        $test_queue = new TestQueue();
                        $test_queue->sales_invoice_id = $test_item->sales_invoice_id;
                        $test_queue->patient_id = $test_item->sales_invoice->patient_id;
                        $test_queue->test_date= $test_item->test_date;
                        //$test_queue->report_date= $test_item->report_date;
                        $test_queue->test_id = $test->test_id;
                        $test_queue->package_id = $test_item->test->id;
                        $test_queue->lab_centre_id = $test_item->sales_invoice->lab_centre_id;
                        $test_queue->collection_centre_id = $test_item->sales_invoice->collection_centre_id;
                        $test_queue->save();
                    }
                }
                else{

                    $test_queue = new TestQueue();

                    $test_queue->sales_invoice_id = $test_item->sales_invoice_id;
                    $test_queue->test_date= $test_item->test_date;
                    //$test_queue->report_date= $test_item->report_date;
                    $test_queue->patient_id = $test_item->sales_invoice->patient_id;
                    $test_queue->test_id = $test_item->test_id;
                    $test_queue->package_id = $test_item->is_package==1? $test_item->test_id:0;
                    $test_queue->lab_centre_id = $test_item->sales_invoice->lab_centre_id;
                    $test_queue->collection_centre_id = $test_item->sales_invoice->collection_centre_id;


                    $test_queue->save();
                  //  DB::commit();
                   // dd($test_queue);
                }


            }
        // });

        return redirect()->route('employee.test_queue.index');
    }
        function test_queue_search(Request $request){
           $data['collections'] = TestQueue::with('sales_invoice','test','test_package','patient')
           ->where('lab_centre_id', $request->lab_centre_id)
           ->whereBetween('test_date', [$request->from_date, $request->to_date])
              ->get();
           //dd($data['collections']);
        //    ->get();

            // $data['collections'] = SalesInvoice::with(['created_by_user', 'patient'])->where('lab_centre_id', $request->lab_centre_id)
            // ->whereBetween(DB::raw("DATE_FORMAT(invoice_date,'%Y-%m-%d')"), [$request->from_date, $request->to_date])
            // ->OrderBy('created_at', 'desc')->get();
            //dd($data);
            $response['body'] = view('employee.test_queue.test_queue_index_body', $data)->render();
            return response()->json($response);
        }

    public function edit($id)
    {
        $user=auth()->user();
        $data['lab_center'] = LabCentre::where('id',$user->lab_centre_id)->first();
        
        // dd($data['test']);
        $test_queue=TestQueue::with('patient','sales_invoice')->where('id',$id)->first();
        // dd($test_queue->test_id);
        $test_id=$test_queue->test_id;
        $data['test'] = Test::find($test_id);
        $data['test_queue']=$test_queue;
        $data['config_header']=view('employee.test_queue.partials._config_header',  $data)->render();
       // dd($data['config_header']);
        $data['tests'] = Test::where('is_package', 0)->get();
        $data['test_report_configs'] = TestReportConfig::where('test_id', $data['test_queue']->test_id)->get();
        if( $data['test_report_configs']->first()==null){
            // toastr("warning","No Config Found");
            return  back()->with('warning','No Config Found');
        }
        // dd($data['test_report_configs']->first()->html);
        $data['components'] = $this->components;
        return view('employee.test_queue.config', $data);
    }
    public function savecode(Request $request)
    {

        // $code=$request->code;
        $test_queue=TestQueue::where('id', $request->test_queue_id)->first();
       // dd($test_queue);
        if($test_queue!=null){

            $test_queue->code=$request->code;
            $test_queue->save();
        }
        return response()->json(['status'=>'success']);

    }
    public function resetcode(Request $request)
    {
        //dd($request->all());
        // $code=$request->code;
        $test_queue=TestQueue::where('id', $request->test_queue_id)->first();
        // dd($test_queue);
        if($test_queue!=null){

            $test_queue->code=null;
            $test_queue->save();
        }
        return response()->json(['status'=>'success']);

    }
    public function getpdf($id){

        $test_queue=TestQueue::where('id', $id)->first();
        $data['html']=$test_queue->code;
        $pdf = Pdf::loadView('employee.test_queue.test_report_pdf', $data, [], [
            'format' => 'A4',
        ]);
        $pdf->SetProtection(['print', 'print-highres'], '', 'pass');
        return $pdf->stream('test_report.pdf');
    }

}
