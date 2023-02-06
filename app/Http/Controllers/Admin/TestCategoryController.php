<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestCategory;
use App\Models\TestGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestCategoryController extends Controller
{
    public $has_enum = [
        'YES' => '1',
        'NO' => '0',
    ];
    public function has_method($value = '')
    {
        return $value == 1 ? 'YES' : 'NO';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['collections'] = TestCategory::all();
        $data['has_enum'] = $this->has_enum;
        return view('admin.test_category.test_category_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['test_group'] = TestGroup::all();
        return response()->json([
            'status' => '200',
            'html' => view('admin.test_category.test_category_create', $data)->render(),
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
        Validator::make($request->all(), [
            'name' => 'required|unique:test_categories',
            'test_group_id' => 'required',
            'has_method' => 'required',
        ]);

        $test_category = new TestCategory();
        $test_category->name = $request->name;
        $test_category->test_group_id = $request->test_group_id;
        $test_category->has_method = $request->has_method;
        $test_category->save();
        return redirect()->route('admin.test_category.index')->with('success', 'Test Category Created Successfully');
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
        $data['test_group'] = TestGroup::all();
        $data['editData'] = TestCategory::find($id);
        return view('admin.test_category.test_category_edit', $data);
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
        Validator::make($request->all(), [
            'name' => 'required|unique:test_categories,name,' . $id,
            'test_group_id' => 'required',
            'has_method' => 'required',
        ]);

        $test_category = TestCategory::find($id);
        $test_category->name = $request->name;
        $test_category->test_group_id = $request->test_group_id;
        $test_category->has_method = $request->has_method;
        $test_category->save();
        return redirect()->route('admin.test_category.index')->with('success', 'Test Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test_category = TestCategory::find($id);
        $test_category->delete();
        return redirect()->route('admin.test_category.index')->with('success', 'Test Category Deleted Successfully');
    }
}
