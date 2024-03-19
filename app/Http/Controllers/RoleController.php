<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Models\RoleModel;
use Illuminate\Http\Request;

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
        return redirect()->route('role');       
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
    public function update(Request $request, RoleModel $roleModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleModel $roleModel, Request $request)
    {
        $Category = RoleModel::where('id', $request->id)->first();
        if (empty($Category)) {
            return response()->json(['check' => false]);
        }
        RoleModel::where('id', $request->id)->delete();
        return response()->json(['check' => true]);
    }
}
