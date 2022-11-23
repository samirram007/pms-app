<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\TestUnit;
use App\Models\TestGroup;
use App\Models\TestCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    protected static  $is_package;
    public function __construct()
    {
        self::$is_package=false;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=Test::where('is_package',0)->get();
        return  view('admin.test.test_index',compact('collections')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['test_categories']=TestCategory::all();
        $data['test_groups']=TestGroup::all();
        $data['test_units']=TestUnit::all();
        return view('admin.test.test_create',$data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'name'=>'required|unique:tests',
            'test_category_id'=>'required',
            'test_group_id'=>'required',
            'amount'=>'required',
        ]);

        $test=new Test();
        $test->name=$request->name;
        $test->alias=$request->alias;
        $test->code=$request->code;
        $test->is_package=0;
        $test->description=$request->description;
        $test->cost=$request->cost;
        $test->amount=$request->amount;
        $test->discount=$request->discount;

        $test->test_duration=$request->test_duration;
        $test->test_category_id=$request->test_category_id;
        $test->test_group_id=$request->test_group_id;
        $test->test_unit_id=$request->test_unit_id;
        $test->has_method=$request->has_method;
        $test->specimen_type=$request->specimen_type;
        $test->test_method=$request->test_method;
        $test->test_method_description=$request->test_method_description;
        $test->reference_range=$request->reference_range;
        $test->inhouse_test=$request->inhouse_test;
        $test->test_value=$request->test_value;
        $test->created_by=Auth::guard('admin')->user()->id;

        $test->save();
        return redirect()->route('admin.test.index')->with('success','Test created successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data['test_categories']=TestCategory::all();
        $data['test_groups']=TestGroup::all();
        $data['test_units']=TestUnit::all();
        $data['editData']=Test::find($id);
        return view('admin.test.test_edit',$data);
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
        Validator::make($request->all(),[
            'name'=>'required|unique:tests,name,'.$id,
            'test_category_id'=>'required',
            'test_group_id'=>'required',
            'amount'=>'required',
        ]);

        $test=Test::find($id);
        $test->name=$request->name;
        $test->alias=$request->alias;
        $test->code=$request->code;
        $test->is_package=0;
        $test->description=$request->description;
        $test->cost=$request->cost;
        $test->amount=$request->amount;
        $test->discount=$request->discount;
        $test->discount=$request->discount;
        $test->test_duration=$request->test_duration;
        $test->test_category_id=$request->test_category_id;
        $test->test_group_id=$request->test_group_id;
        $test->test_unit_id=$request->test_unit_id;
        $test->has_method=$request->has_method;
        $test->specimen_type=$request->specimen_type;
        $test->test_method=$request->test_method;
        $test->test_method_description=$request->test_method_description;
        $test->reference_range=$request->reference_range;
        $test->inhouse_test=$request->inhouse_test;
        $test->test_value=$request->test_value;
        $test->updated_by=Auth::guard('admin')->user()->id;

        $test->save();
        return redirect()->route('admin.test.index')->with('success','Test updated successfully');
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



    public function GetCategoryByGroupID(Request $request)
    {
        //dd($request['test_group_id']);
        $test_group_id = $request['test_group_id'];
        $response = TestCategory::where('test_group_id',$test_group_id)->get();
        return response()->json($response);
        //return response()->json(["status" => true, "data" => $response]);
    }
}
