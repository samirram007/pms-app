<?php

namespace App\Http\Controllers\Employee;

use App\Models\Associate;
use App\Models\LabCentre;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\CollectionCentre;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=Associate::all();
        return  view('employee.associate.associate_index',compact('collections'));
    }
public function select($id)
{
    # add userid to session cart
    //session()->put('associate_id', $id);
    return redirect()->route('employee.sales_order.sales_order_preview');

}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['associate']=Associate::all();
        $data['lab_centre']=LabCentre::all();
        $data['collection_centre']=CollectionCentre::all();
        return view('employee.associate.associate_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(Auth::guard('employee')->user());
        Validator::make($request->all(),[
            'name' => 'required',
            'contact_no' => 'required|unique:associates',
        ]);
        $associate=new Associate();
        $associate->name=$request->name;
        // $associate->code=$request->code;
        $associate->password=bcrypt('password');
        $associate->email=$request->email;
        $associate->contact_no=$request->contact_no;
        $associate->address=$request->address;

        $associate->lab_centre_id=Auth::guard('employee')->user()->lab_centre_id;
        $associate->collection_centre_id=Auth::guard('employee')->user()->collection_centre_id;

        $associate->created_by=Auth::guard('employee')->user()->id;

        // if($request->file('image')){
        //     $file=$request->file('image');
        //     // @unlink(public_path('upload/user_images/'.$associate->image));
        //     $filename=date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/user_images'),$filename);
        //     $associate['image']=$filename;
        // }
        $associate->save();
        return redirect()->route('employee.associate.index')->with('success','Associate Created Successfully');
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

        $data['lab_centre']=LabCentre::all();
        $data['collection_centre']=CollectionCentre::all();
        $data['editData']=Associate::find($id);
        return view('employee.associate.associate_edit',$data);
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
            'name' => 'required',
            'contact_no' => 'required|unique:associates,contact_no,'.$id,
        ]);
        $associate=Associate::find($id);
        $associate->name=$request->name;
        // $associate->code=$request->code;
        $associate->email=$request->email;
        $associate->contact_no=$request->contact_no;
        $associate->address=$request->address;

        $associate->lab_centre_id=Auth::guard('employee')->user()->lab_centre_id;
        $associate->collection_centre_id=Auth::guard('employee')->user()->collection_centre_id;

        $associate->updated_by=Auth::guard('employee')->user()->id;

        // if($request->file('image')){
        //     $file=$request->file('image');
        //     @unlink(public_path('upload/user_images/'.$associate->image));
        //     $filename=date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/user_images'),$filename);
        //     $associate['image']=$filename;
        // }
        $associate->save();
        return redirect()->route('employee.associate.index')->with('success','Employee Updated Successfully');
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
}
