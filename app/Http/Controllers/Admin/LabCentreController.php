<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabCentre;
use Illuminate\Http\Request;

class LabCentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = LabCentre::all();
        return view('admin.lab_centre.lab_centre_index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'status' => '200',
            'html' => view('admin.lab_centre.lab_centre_create')->render(),
        ]);

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
            'name' => 'required|unique:lab_centres',
        ]);
        $collection = new LabCentre();
        $collection->name = $request->name;
        $collection->code = $request->code;
        $collection->password = bcrypt('password');
        $collection->date_of_foundation = $request->date_of_foundation;
        $collection->license_no = $request->license_no;
        $collection->address = $request->address;
        $collection->contact_no = $request->contact_no;
        $collection->email = $request->email;
        $collection->save();
        return redirect()->route('admin.lab_centre.index')->with('success', 'Lab Centre Created Successfully');
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
        $editData = LabCentre::find($id);
        return view('admin.lab_centre.lab_centre_edit', compact('editData'));
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
            'name' => 'required|unique:lab_centres,name,' . $id,
        ]);
        $collection = LabCentre::find($id);
        $collection->name = $request->name;
        $collection->code = $request->code;
        $collection->date_of_foundation = $request->date_of_foundation;
        $collection->license_no = $request->license_no;
        $collection->address = $request->address;
        $collection->contact_no = $request->contact_no;
        $collection->email = $request->email;
        $collection->save();
        return redirect()->route('admin.lab_centre.index')->with('success', 'Lab Centre Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = LabCentre::find($id);
        $collection->delete();
        return redirect()->route('admin.lab_centre.index')->with('success', 'Lab Centre Deleted Successfully');
    }
}
