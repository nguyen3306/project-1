<?php

namespace App\Http\Controllers;

use App\Imports\CarsImport;
use App\Models\CarsModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = CarsModel::all();
        return view('main.cars.cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(CarsModel $carsModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarsModel $carsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarsModel $carsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarsModel $carsModel)
    {
        //
    }


    public function test()
    {
        // $role = RoleModel::all();
        return view('main.cars.cars');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function import(Request $request)
    {
        $importObject = new CarsImport() ;

        Excel::import($importObject, $request->file('file'));
        $result = $importObject->getResultImport();
        return redirect()->route('cars');
    }
}
