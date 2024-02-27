<?php

namespace App\Http\Controllers;

use App\Models\CateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cate = CateModel::all();
        return view("main.home",compact('cate'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        $validator = Validator::make($request->all(), [
            'cate' => 'required|unique:category,name',
        ],[
            'cate.required'=> 'Chưa có tên loại',
            'cate.unique'=> 'Tên loại bị trùng',
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()]);
        }
        // $data = [
        //     'name' => $request->cate,
        //     // 'idTeacher' => $request->username,
        // ];
        CateModel::create(['name'=> $request->cate]);
        return response()->json(['check'=>true]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CateModel $cateModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CateModel $cateModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CateModel $cateModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CateModel $cateModel,request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=> 'required|numeric|exists:category,id',
        ], [
            'id.required'=> 'Mã loại xe sai',
            'id.exists'=> 'Mã loại xe không tồn tại',
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()]);
    }
    CateModel::where('id',$request->id)->delete();
    return response()->json(['check'=>true]);
    }
}
