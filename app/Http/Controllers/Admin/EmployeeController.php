<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\LabCentre;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\CollectionCentre;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $collections=Employee::with('lab_centre')->get(); 
        //dd($collections);
        return  view('admin.employee.employee_index',compact('collections')); 
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
        return view('admin.employee.employee_create',$data);    
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
            'email' => 'required|unique:employees',  
        ]);
        $employee=new Employee();
        $employee->name=$request->name; 
        $employee->code=$request->code;
        $employee->password=bcrypt('password');
        $employee->email=$request->email;
        $employee->contact_no=$request->contact_no;
        $employee->dob=$request->dob;
        $employee->doj=$request->doj;
        $employee->address=$request->address;

        $employee->department_id=$request->department_id;
        $employee->designation_id=$request->designation_id;
        $employee->lab_centre_id=$request->lab_centre_id;
        $employee->collection_centre_id=$request->collection_centre_id; 
        $employee->qualification=$request->qualification;
        
        if($request->file('image')){
            $file=$request->file('image');
            // @unlink(public_path('upload/user_images/'.$employee->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $employee['image']=$filename;
        }
        $employee->save();
        return redirect()->route('admin.employee.index')->with('success','Employee Created Successfully');
        
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
        $data['editData']=Employee::find($id);
        
        return view('admin.employee.employee_edit',$data);    
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
            'email' => 'required|unique:employees,email,'.$id,  
        ]);
        $employee=Employee::find($id);
        $employee->name=$request->name; 
        $employee->code=$request->code;
        $employee->password=bcrypt('password');
        $employee->email=$request->email;
        $employee->contact_no=$request->contact_no;
        $employee->dob=$request->dob;
        $employee->doj=$request->doj;
        $employee->address=$request->address;

        $employee->department_id=$request->department_id;
        $employee->designation_id=$request->designation_id;
        $employee->lab_centre_id=$request->lab_centre_id;
        $employee->collection_centre_id=$request->collection_centre_id; 
        $employee->qualification=$request->qualification;
        if($request->file('image')){
            $file=$request->file('image');
             @unlink(public_path('upload/user_images/'.$employee->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $employee['image']=$filename;
        }
        $employee->save();
        return redirect()->route('admin.employee.index')->with('success','Employee Updated Successfully');
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
