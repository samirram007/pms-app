<?php

namespace App\Http\Controllers\Admin;

use App\Models\DiscountType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscountTypeController extends Controller
{
    public static $discount_by = ['percentage', 'value'];
    public static $discount_for = ['cart', 'test','test_group','test_category','associate','patient','department','package'];
    public function __construct()
    {
     //   $this->middleware('auth:admin');
        
    }
     
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=DiscountType::all();
         
        return view('admin.discount_type.discount_type_index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[
            'discount_by'=>self::$discount_by,
            'discount_for'=>self::$discount_for,
        ];
        return view('admin.discount_type.discount_type_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:discount_types',
        ]);
        $collection=new DiscountType();
        $collection->name=$request->name;     
        $collection->description=$request->description;
        $collection->discount_by=$request->discount_by;
        $collection->discount=$request->discount;
        $collection->discount_for=$request->discount_for;

        $collection->save();
        return redirect()->route('admin.discount_type.index')->with('success','Discount Type Created Successfully');
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
        $data['editData']=DiscountType::find($id);
        $data['discount_by']=self::$discount_by;
        $data['discount_for']=self::$discount_for;
        
        return view('admin.discount_type.discount_type_edit',$data);
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
        $request->validate([
            'name'=>'required|unique:discount_types,name,'.$id,
        ]);
        $collection=DiscountType::find($id);
        $collection->name=$request->name;     
        $collection->description=$request->description;
        $collection->discount_by=$request->discount_by;
        $collection->discount=$request->discount;
        $collection->discount_for=$request->discount_for;

        $collection->save();
        return redirect()->route('admin.discount_type.index')->with('success','Discount Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection=DiscountType::find($id);
        $collection->delete();
        return redirect()->route('admin.discount_type.index')->with('success','Discount Type Deleted Successfully');
    }
}
