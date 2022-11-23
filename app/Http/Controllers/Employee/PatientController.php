<?php

namespace App\Http\Controllers\Employee;

use App\Models\Patient;
use App\Models\LabCentre;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\CollectionCentre;
use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\ReferralDoctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public static $gender = ['Male', 'Female','Other'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=Patient::with('lab_centre')->get();
        return  view('employee.patient.patient_index',compact('collections'));
    }
public function select($id)
{
    # add userid to session cart
    session()->put('patient_id', $id);
    $sales_order = session()->has('sales_order') ? session()->get('sales_order') : [];
    if (!$sales_order) {
        $sales_order = [];
    }
    $sales_order['patient_id'] = $id;
    session()->put('sales_order', $sales_order);
    return redirect()->route('employee.sales_order.sales_order_preview');

}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['gender']=self::$gender;
        $data['associate']=Associate::all();
        $data['lab_centre']=LabCentre::all();
        $data['collection_centre']=CollectionCentre::all();
        $data['referral_doctor']=ReferralDoctor::all();
        return view('employee.patient.patient_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd($request->all());
        //dd(Auth::guard('employee')->user());
        Validator::make($request->all(),[
            'name' => 'required',
        ]);
        $patient=new Patient();
        $patient->name=$request->name;
        $patient->code=$request->code;
        $patient->password=bcrypt('password');
        $patient->email=$request->email;
        $patient->contact_no=$request->contact_no;
        $patient->dob=$request->dob;
        $patient->age=$request->age;
        $patient->gender=$request->gender;
        $patient->address=$request->address;
        $patient->doctor_name=$request->doctor_name;
        $patient->referral_doctor_id=$request->referral_doctor_id;
        $patient->associate_id=$request->associate_id;


        $patient->lab_centre_id=Auth::guard('employee')->user()->lab_centre_id;
        $patient->collection_centre_id=Auth::guard('employee')->user()->collection_centre_id;

        $patient->created_by=Auth::guard('employee')->user()->id;

        // if($request->file('image')){
        //     $file=$request->file('image');
        //     // @unlink(public_path('upload/user_images/'.$patient->image));
        //     $filename=date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/user_images'),$filename);
        //     $patient['image']=$filename;
        // }
        $patient->save();
        return redirect()->route('employee.patient.index')->with('success','Employee Created Successfully');
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
        $data['gender']=self::$gender;
        $data['associate']=Associate::all();
        $data['lab_centre']=LabCentre::all();
        $data['collection_centre']=CollectionCentre::all();
        $data['referral_doctor']=ReferralDoctor::all();
        $data['editData']=Patient::find($id);
        return view('employee.patient.patient_edit',$data);
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
            'contact_no' => 'required|unique:patients,contact_no,'.$id,
        ]);
        $patient=Patient::find($id);
        $patient->name=$request->name;
        $patient->code=$request->code;
        $patient->email=$request->email;
        $patient->contact_no=$request->contact_no;
        $patient->dob=$request->dob;
        $patient->age=$request->age;
        $patient->gender=$request->gender;
        $patient->address=$request->address;
        $patient->doctor_name=$request->doctor_name;
        $patient->referral_doctor_id=$request->referral_doctor_id;
        $patient->associate_id=$request->associate_id;

        $patient->lab_centre_id=Auth::guard('employee')->user()->lab_centre_id;
        $patient->collection_centre_id=Auth::guard('employee')->user()->collection_centre_id;

        $patient->updated_by=Auth::guard('employee')->user()->id;

        // if($request->file('image')){
        //     $file=$request->file('image');
        //     // @unlink(public_path('upload/user_images/'.$patient->image));
        //     $filename=date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/user_images'),$filename);
        //     $patient['image']=$filename;
        // }
        $patient->save();
        return redirect()->route('employee.patient.index')->with('success','Employee Updated Successfully');
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
