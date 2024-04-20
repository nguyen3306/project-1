<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Imports\CarsImport;
use App\Models\CarsModel;
use App\Models\CateModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Validator;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cate = CarsModel::all();
        $cate = CateModel::all();
        $cars = DB::table('cars')->join('category', 'cars.cate_id', '=', 'category.id')->select('cars.*', 'category.name as catename')->get();
        // dd($cars);

        return view('main.cars.cars', compact('cars','cate'));
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
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:255|string',
            'brand'=> 'required|max:255|string',
            'seat'=> 'required|max:30|min:4|string',
            'date'=> 'string|min:2015|max:2024|reqired',
            'image'=> 'nullable|mimes:png,jpg,jpeg',
            'descrription'=> 'required|string|unique:cars,description',
            'price'=> 'required|numeric',
            'category'=> 'required',
        ]);


        if($request->has('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = 'upload/img/';
            $file->move($path, $fileName);


            CarsModel::create([
                'name'=>$request->name,
                'brand'=>$request->brand,
                'seat'=>$request->seat,
                'date'=>$request->date,
                'img'=> $path.$fileName,
                'cate_id'=>$request->category,
                'description'=>$request->description,
                'price'=>$request->price,
    
            ]);
        }
        CarsModel::create([
            'name'=>$request->name,
            'brand'=>$request->brand,
            'seat'=>$request->seat,
            'date'=>$request->date,
            'cate_id'=>$request->category,
            'description'=>$request->description,
            'price'=>$request->price,

        ]);

        

        return redirect('/cars')->with('success','success');
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
    public function edit($id, Request $request)
    {
        $cate = CateModel::all();
        $car = CarsModel::where('id', $id)->first();
        // dd($user);
        return view('main.cars.update', compact('car','cate'),);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarsModel $carsModel)
    {
        $data = [
            'name' => $request->name,
            'brand' => $request->brand,
            'cate_id' => $request->cate,
            'seat' => $request->seat,
            'date' => $request->date,
            'description' => $request->description,
            'price' => $request->price,
        ];
        // dd($data);

        $car = CarsModel::where('id',$request->id)->update($data);
        return redirect('/cars');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,CarsModel $carsModel)
    {
        CarsModel::where('id',$request->id)->delete();
        return response()->json(['check' => true]);

    }


    public function test()
    {
        // $role = RoleModel::all();
        // return view('main.cars.cars');
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
