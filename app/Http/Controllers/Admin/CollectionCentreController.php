<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionCentre;
use App\Models\LabCentre;
use Illuminate\Http\Request;

class CollectionCentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = CollectionCentre::with('lab_centre')->get();

        return view('admin.collection_centre.collection_centre_index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['lab_centre'] = LabCentre::all();
        return response()->json([
            'status' => '200',
            'html' => view('admin.collection_centre.collection_centre_create', $data)->render(),
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
            'name' => 'required|unique:collection_centres',
        ]);
        $collection = new CollectionCentre();
        $collection->name = $request->name;
        $collection->code = $request->code;
        $collection->password = bcrypt('password');

        $collection->lab_centre_id = $request->lab_centre_id;
        $collection->date_of_foundation = $request->date_of_foundation;
        $collection->license_no = $request->license_no;
        $collection->address = $request->address;
        $collection->contact_no = $request->contact_no;
        $collection->email = $request->email;
        $collection->save();
        return redirect()->route('admin.collection_centre.index')->with('success', 'Collection Centre Created Successfully');
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
        $data['lab_centre'] = LabCentre::all();
        $data['editData'] = CollectionCentre::find($id);
        return view('admin.collection_centre.collection_centre_edit', $data);
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
            'name' => 'required|unique:collection_centres,name,' . $id,
        ]);
        $collection = CollectionCentre::find($id);
        $collection->name = $request->name;
        $collection->code = $request->code;
        $collection->lab_centre_id = $request->lab_centre_id;
        $collection->date_of_foundation = $request->date_of_foundation;
        $collection->license_no = $request->license_no;
        $collection->address = $request->address;
        $collection->contact_no = $request->contact_no;
        $collection->email = $request->email;
        $collection->save();
        return redirect()->route('admin.collection_centre.index')->with('success', 'Collection Centre Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = CollectionCentre::find($id);
        $collection->delete();
        return redirect()->route('admin.collection_centre.index')->with('success', 'Collection Centre Deleted Successfully');
    }
}
