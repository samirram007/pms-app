<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TestUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $collections=TestUnit::all();
        return  view('admin.test_unit.test_unit_index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.test_unit.test_unit_create');
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
            'name'=>'required|unique:test_units',
        ]);
        $test_unit=new TestUnit();
        $test_unit->name=$request->name;
        $test_unit->code=$request->code;
        $test_unit->save();
        return redirect()->route('admin.test_unit.index')->with('success','Test Unit Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // test unit show


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData=TestUnit::find($id);
        return view('admin.test_unit.test_unit_edit',compact('editData'));
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
            'name'=>'required|unique:test_units,name,'.$id,
        ]);
        $test_unit=TestUnit::find($id);
        $test_unit->name=$request->name;
        $test_unit->code=$request->code;
        $test_unit->save();
        return redirect()->route('admin.test_unit.index')->with('success','Test Unit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test_unit=TestUnit::find($id);
        $test_unit->delete();
        return redirect()->route('admin.test_unit.index')->with('success','Test Unit Deleted Successfully');
    }
}
