<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCateRequest;
use App\Models\CateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateCateRequest;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cate = CateModel::all();
        return view("main.cate", compact('cate'));

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
    public function store(CreateCateRequest $request)
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

        CateModel::create(['name' => $request->cate]);
        return response()->json(['check' => true]);
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
    public function update(UpdateCateRequest $request, CateModel $cateModel)
    {
        CateModel::where('id', $request->id)->update(['name' => $request->newCate, 'created_at' => now()]);
        return response()->json(['check' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CateModel $cateModel, request $request)
    {

        $Category = CateModel::where('id', $request->id)->first();
        if (empty($Category)) {
            return response()->json(['check' => false]);
        }
        CateModel::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }
}
