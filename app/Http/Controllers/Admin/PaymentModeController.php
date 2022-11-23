<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentMode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentModeController extends Controller
{
      
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']='Payment Mode List';
        $data['create_route']='admin.payment_mode.create';
        $data['edit_route']='admin.payment_mode.edit';
        $data['show_route']='admin.payment_mode.show';
        $data['delete_route']='admin.payment_mode.delete';
        $data['index_route']='admin.payment_mode.index';
        $data['collections']=PaymentMode::all();
         
        return view('admin.payment_mode.payment_mode_index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']='Create Payment Mode';
        $data['save_route']='admin.payment_mode.store';
        $data['index_route']='admin.payment_mode.index';
        return view('admin.payment_mode.payment_mode_create',$data);
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
            'name'=>'required|unique:payment_modes',
        ]);
        $collection=new PaymentMode();
        $collection->name=$request->name;     
        $collection->description=$request->description; 
        if($request->file('image')){
            $file=$request->file('image');
            // @unlink(public_path('upload/user_images/'.$collection->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $collection['image']=$filename;
        }

        $collection->save();
        return redirect()->route('admin.payment_mode.index')->with('success','Payment Mode Created Successfully');
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
        $data['title']='Create Payment Mode';
        $data['update_route']='admin.payment_mode.update';
        $data['index_route']='admin.payment_mode.index';
        $data['editData']=PaymentMode::find($id); 
        
        return view('admin.payment_mode.payment_mode_edit',$data);
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
            'name'=>'required|unique:payment_modes,name,'.$id,
        ]);
        $collection=PaymentMode::find($id);
        $collection->name=$request->name;     
        $collection->description=$request->description; 
        if($request->file('image')){
            $file=$request->file('image');
             @unlink(public_path('upload/user_images/'.$collection->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $collection['image']=$filename;
        }

        $collection->save();
        return redirect()->route('admin.payment_mode.index')->with('success','Payment Mode Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection=PaymentMode::find($id);
        $collection->delete();
        return redirect()->route('admin.payment_mode.index')->with('success','Payment Mode Deleted Successfully');
    }
}
