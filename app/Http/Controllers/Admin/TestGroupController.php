<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestGroup;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TestGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=TestGroup::all();
        return  view('admin.test_group.test_group_index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $data['department']=Department::all();
        return view('admin.test_group.test_group_create',$data);
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
            'name'=>'required|unique:test_groups',
            'department_id'=>'required',
        ]);

        $test_group=new TestGroup();
        $test_group->name=$request->name; 
        $test_group->department_id=$request->department_id;
        $test_group->save();
        return redirect()->route('admin.test_group.index')->with('success','Test Group Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // test_group_show
        $data['showData']=TestGroup::find($id);
        return view('admin.test_group.test_group_show',$data);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData']=TestGroup::find($id);
        $data['department']=Department::all();
        return view('admin.test_group.test_group_edit',$data);
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
            'name'=>'required|unique:test_groups,name,'.$id,
            'department_id'=>'required',
        ]);

        $test_group=TestGroup::find($id);
        $test_group->name=$request->name; 
        $test_group->department_id=$request->department_id;
        $test_group->save();
        return redirect()->route('admin.test_group.index')->with('success','Test Group Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test_group=TestGroup::find($id);
        $test_group->delete();
        return redirect()->route('admin.test_group.index')->with('success','Test Group Deleted Successfully');
    }
}
