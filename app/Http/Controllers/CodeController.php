<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestReportConfig;

class CodeController extends Controller
{
    public function savecode(Request $request)
    {

        // $code=$request->code;
        $test_config=TestReportConfig::where('test_id', $request->test_id)->first();
        if($test_config==null){
            $data =new TestReportConfig();
            $data->test_id=$request->test_id;
            $data->html=$request->code;

            $data->save();

           // dd($data);
        }
        else{
            $test_config->html=$request->code;
            $test_config->save();
        }
        return response()->json(['status'=>'success']);

    }
    public function loadcode(Request $request){
        // dd($request->all());

        $test_report_config=TestReportConfig::where('test_id', $request->test_id)->first();
        // dd($test_report_config->html);
        $html= $test_report_config->html;
        // $user=auth()->user();
        // $data['lab_center'] = LabCentre::where('id',$user->lab_centre_id)->first();
        // $data['test'] = Test::find($id);
        // // dd($data['test']);
        // $data['tests'] = Test::where('is_package', 0)->get();
         //$html=view($html,$data)->render();
        // dd($html);
        // dd($html);
        return response()->json(['status'=>'success','html'=>$html]);
    }
    function storecode(Request $request){
        $code = $request->code;
        $filename = $request->filename;
        $file = fopen($filename,"w");
        fwrite($file,$code);
        fclose($file);
        return redirect()->back();
    }
    function getcode(Request $request){
        $filename = $request->filename;
        $file = fopen($filename,"r");
        $code = fread($file,filesize($filename));
        fclose($file);
        return $code;
    }
}
