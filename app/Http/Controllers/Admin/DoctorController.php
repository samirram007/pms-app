<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\LabCentre;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\CollectionCentre;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $collections=Doctor::all(); 
        return  view('admin.doctor.doctor_index',compact('collections')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['department']=Department::all();
        $data['designation']=Designation::all();
        $data['lab_centre']=LabCentre::all();
        $data['collection_centre']=CollectionCentre::all();
        return view('admin.doctor.doctor_create',$data);    
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
            'name' => 'required',
            'email' => 'required|unique:doctors',  
        ]);
        $doctor=new Doctor();
        $doctor->name=$request->name; 
        $doctor->code=$request->code;
        $doctor->password=bcrypt('password');
        $doctor->email=$request->email;
        $doctor->contact_no=$request->contact_no;
        $doctor->dob=$request->dob;
        $doctor->doj=$request->doj;
        $doctor->address=$request->address;

        $doctor->department_id=$request->department_id;
        $doctor->designation_id=$request->designation_id;
        $doctor->lab_centre_id=$request->lab_centre_id;
        $doctor->collection_centre_id=$request->collection_centre_id; 
        $doctor->qualification=$request->qualification;
        if($request->file('image')){
            $file=$request->file('image');
            //@unlink(public_path('upload/user_images/'.$doctor->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $doctor['image']=$filename;
        }
        $doctor->save();
        return redirect()->route('admin.doctor.index')->with('success','Doctor Created Successfully');
        
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
        $data['department']=Department::all();
        $data['designation']=Designation::all();
        $data['lab_centre']=LabCentre::all();
        $data['collection_centre']=CollectionCentre::all();
        $data['editData']=Doctor::find($id);
        
        return view('admin.doctor.doctor_edit',$data);    
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
            'email' => 'required|unique:doctors,email,'.$id,  
        ]);
        $doctor=Doctor::find($id);
        $doctor->name=$request->name; 
        $doctor->code=$request->code; 
        $doctor->email=$request->email;
        $doctor->contact_no=$request->contact_no;
        $doctor->dob=$request->dob;
        $doctor->doj=$request->doj;
        $doctor->address=$request->address;

        $doctor->department_id=$request->department_id;
        $doctor->designation_id=$request->designation_id;
        $doctor->lab_centre_id=$request->lab_centre_id;
        $doctor->collection_centre_id=$request->collection_centre_id; 
        $doctor->qualification=$request->qualification;
        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('upload/user_images/'.$doctor->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $doctor['image']=$filename;
        }
        $doctor->save();
        return redirect()->route('admin.doctor.index')->with('success','Doctor Updated Successfully');
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
