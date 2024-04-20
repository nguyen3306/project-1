<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UpdateCateRequest;
use App\Models\CateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateCateRequest;
use Maatwebsite\Excel\Facades\Excel;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cate = CateModel::all();
        return view("main.cate.cate", compact('cate'));

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(CreateCateRequest $request)
    // {

    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'cate' => 'required|unique:category,name',
        // ],[
        //     'cate.required'=> 'Chưa có tên loại',
        //     'cate.unique'=> 'Tên loại bị trùng',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['check'=>false,'msg'=>$validator->errors()]);
        // }
        // $data = [
        //     'name' => $request->cate,
        //     // 'idTeacher' => $request->username,
        // ];
            // dd($request->all());
        CateModel::create(['name' => $request->addCate]);
        return response()->json(['check' => true]);
    }


    /**
     * Display the specified resource.
     */
    public function export(Request $request)
    {
        $user=CateModel::all();
        if ($request->get("export_excel")&&$request->get('export_excel')==1) {
            $valueUser=$user;
            $timestamp = now()->format('Y_m_d_H_i_s_');
            $name = 'User_Excel_' . $timestamp . '_' . rand() . '.xlsx';
            ob_end_clean();
            return Excel::download(new UsersExport, $name);
        }
        return view('main.cate.cate');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update ($id, UpdateCateRequest  $request)
    {
        // dd($request->all(),$id);
        CateModel::where('id', $id)->update(['name' => $request->cate]);
        return response()->json(['check' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $Category = CateModel::where('id', $request->id)->first();
        if (empty($Category)) {
            return response()->json(['check' => false]);
        }
        CateModel::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }
}
