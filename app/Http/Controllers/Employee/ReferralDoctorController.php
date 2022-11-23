<?php

namespace App\Http\Controllers\Employee;

use App\Models\ReferralDoctor;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReferralDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=ReferralDoctor::all();
        return  view('employee.referral_doctor.referral_doctor_index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          
        return view('employee.referral_doctor.referral_doctor_create' );
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
            'name'=>'required|unique:referral_doctors', 
        ]);

        $referral_doctor=new ReferralDoctor();
        $referral_doctor->name=$request->name;  
        $referral_doctor->qualification=$request->qualification;
        $referral_doctor->email=$request->email;
        $referral_doctor->contact_no=$request->contact_no;
        $referral_doctor->save();
        return redirect()->route('employee.referral_doctor.index')->with('success','Referral Doctor Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // referral_doctor_show
        $data['showData']=ReferralDoctor::find($id);
        return view('employee.referral_doctor.referral_doctor_show',$data);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData']=ReferralDoctor::find($id); 
        return view('employee.referral_doctor.referral_doctor_edit',$data);
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
            'name'=>'required|unique:referral_doctors,name,'.$id, 
        ]);

        $referral_doctor=ReferralDoctor::find($id);
        $referral_doctor->name=$request->name; 
        $referral_doctor->qualification=$request->qualification;
        $referral_doctor->email=$request->email;
        $referral_doctor->contact_no=$request->contact_no;
        $referral_doctor->save();
        return redirect()->route('employee.referral_doctor.index')->with('success','Referral Doctor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $referral_doctor=ReferralDoctor::find($id);
        $referral_doctor->delete();
        return redirect()->route('employee.referral_doctor.index')->with('success','Referral Doctor Deleted Successfully');
    }
}
