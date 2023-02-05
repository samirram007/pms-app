<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestPackage;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PackageController extends Controller
{
    protected static $is_package;
    public function __construct()
    {
        self::$is_package = true;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collections = Package::with(['test_package','test_package.test' ])->get();
        $data['collections'] = Test::where('is_package', 1)->get();
        foreach ($data['collections'] as $key => $item) {
            if ($item->is_package == 1) {
                $item->test_packages = TestPackage::with('test')->where('package_id', $item->id)->get();

            }

            // $data['total_amount']+=$item->amount*$data['cart'][$item->id]['qty'];
        }

        //dd( $data['collections'] );
        return view('admin.package.package_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['collection'] = Test::where('is_package', 0)->get();
        return response()->json([
            'status' => '200',
            'html' => view('admin.package.package_create', $data)->render(),
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
            'name' => 'required|unique:tests',
            'amount' => 'required',
        ]);
        // ($request->all());
        $package = new Test();
        $package->name = $request->name;
        $package->amount = $request->amount;
        $package->cost = $request->cost;
        $package->discount = $request->discount;
        $package->is_package = 1;
        $package->code = $request->code;
        $package->description = $request->description;
        $package->start_date = $request->start_date;
        $package->end_date = $request->end_date;
        $package->created_by = Auth::guard('admin')->user()->id;
        $package->save();

        $countTest = count($request->test_id);
        if ($countTest != null) {

            for ($i = 0; $i < $countTest; $i++) {

                $test_package = ($request->test_package_id[$i]) == '' ? $exp = new TestPackage() : TestPackage::find($request->test_package_id[$i]);

                // $test_package->amount = $request->test_amount[$i];
                $test_package->test_id = $request->test_id[$i];
                $test_package->package_id = $package->id;

                $test_package->save();
                //dd($test_package);
            }
        }

        return redirect()->route('admin.package.index')->with('success', 'Package created successfully');
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
        $data['collection'] = Test::where('is_package', 0)->get();
        $data['editData'] = Test::find($id);
        $data['test_package'] = TestPackage::with('test')
            ->where('package_id', $id)->get();

        return view('admin.package.package_edit', $data);
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
            'name' => 'required|unique:tests,name,' . $id,
            'amount' => 'required',
        ]);
        $package = Test::find($id);
        $package->name = $request->name;
        $package->amount = $request->amount;
        $package->cost = $request->cost;
        $package->discount = $request->discount;
        $package->code = $request->code;
        $package->is_package = 1;
        $package->description = $request->description;
        $package->start_date = $request->start_date;
        $package->end_date = $request->end_date;
        $package->updated_by = Auth::guard('admin')->user()->id;
        $package->save();
        $countTest = count($request->test_id);
        if ($countTest != null) {

            for ($i = 0; $i < $countTest; $i++) {

                $test_package = ($request->test_package_id[$i]) == '' ? $exp = new TestPackage() : TestPackage::find($request->test_package_id[$i]);

                // $test_package->amount = $request->test_amount[$i];
                $test_package->test_id = $request->test_id[$i];
                $test_package->package_id = $package->id;
                $test_package->save();
                //dd($test_package);
            }
        }

        return redirect()->route('admin.package.index')->with('success', 'Package updated successfully');
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
    public function delete_test_package($tpid)
    {
        $package = TestPackage::find($tpid);
        $package->delete();
        return redirect()->back()->with('success', 'Test Package deleted successfully');
        // return response()->json([
        //     'success'=>'Test Package deleted successfully'
        // ]);
    }

    public function gettest(Request $request)
    {
        $test_id = $request->test_id;
        $data['test'] = Test::find($test_id);
        //dd($data);
        $GetView = view('admin.package.test_row', $data)->render();
        return response()->json([
            "status" => true,
            "html" => $GetView,
        ]);
    }
}
