<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Imports\CarsImport;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = RoleModel::all();
        return view('main.role.role',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        // dd($request->all());
        RoleModel::create(['name' => $request->role]);
        // return response()->json(['check' => true]);
        return response()->json(['check' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleModel $roleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleModel $roleModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request, RoleModel $roleModel)
    {
        RoleModel::where('id', $id)->update(['name' => $request->role]);
        return response()->json(['check' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleModel $roleModel, Request $request)
    {
        RoleModel::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }





    
}
