<?php

namespace App\Http\Controllers;

use App\Imports\CarsImport;
use App\Models\CarsModel;
use App\Models\CateModel;
use App\Models\img;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


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

        return view('main.cars.cars', compact('cars', 'cate'));
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
            'name' => 'required|max:255|string',
            'brand' => 'required|max:255|string',
            'seat' => 'required|numeric|min:2|max:5',
            'date' => 'numeric|min:2015|max:2025|required',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'description' => 'required|string|unique:cars,description',
            'price' => 'required|numeric',
            'category' => 'required',
        ], [
            'name.required' => 'Tên xe không được để trống',
            'name.max' => 'Tên xe không được quá 255 ký tự',
            'brand.required' => 'Hãng xe không được để trống',
            'brand.max' => 'Hãng xe không được quá 255 ký tự',
            'seat.required' => 'Số chỗ ngồi không được để trống',
            'date.required' => 'Năm sản xuất không được để trống',
            'date.min' => 'Năm sản xuất phải từ năm 2015 trở lên',
            'date.max' => 'Năm sản xuất phải từ năm 2024 trở xuống',
            'image.mimes' => 'Hình ảnh phải là định dạng png, jpg, jpeg',
            'description.required' => 'Mô tả không được để trống',
            'description.unique' => 'Mô tả đã tồn tại',
            'price.required' => 'Giá xe không được để trống',
            'price.numeric' => 'Giá xe phải là số',
            'category.required' => 'Danh mục không được để trống',

        ]);
        // dd($validator);
        if ($validator->fails()) {
            return response()->json(['check' => false, 'msg' => $validator->errors()]);
        }


        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'upload/img/';
            $file->move($path, $fileName);


            CarsModel::create([
                'name' => $request->name,
                'brand' => $request->brand,
                'seat' => $request->seat,
                'date' => $request->date,
                'img' => $path . $fileName,
                'cate_id' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        }






        return redirect()->route('cars')->with('success', 'thành công');
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
        // dd($car);
        return view('main.cars.update', compact('car', 'cate'),);
    }


    public function oder($id, Request $request)
    {
        $cate = CateModel::all();
        $car = CarsModel::where('id', $id)->first();

        // dd($oder);
        return view('main.oder.carorder', compact('cate', 'car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarsModel $carsModel, img $img)
    {
        if ($request->has('image')) {
            $data = CarsModel::find($request->id);
            $image = $data->img;
            if (file::exists($image)) {
                file::delete($image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'upload/img/';
            $file->move($path, $fileName);
            $data1 = [
                'name' => $request->name,
                'brand' => $request->brand,
                'cate_id' => $request->cate,
                'seat' => $request->seat,
                'date' => $request->date,
                'description' => $request->description,
                'price' => $request->price,
                'img' => $path . $fileName,
            ];
            $car = CarsModel::where('id', $request->id)->update($data1);
        } else {
            $data = [
                'name' => $request->name,
                'brand' => $request->brand,
                'cate_id' => $request->cate,
                'seat' => $request->seat,
                'date' => $request->date,
                'description' => $request->description,
                'price' => $request->price,
            ];
            $car = CarsModel::where('id', $request->id)->update($data);
        }
        if ($request->has('multiplePic')) {
            $files = [];

            foreach ($request->file('multiplePic') as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $path = 'upload/CarsImages';
                dd($file);

                $file->move($path, $fileName);
            }
        }

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CarsModel $carsModel)
    {
        $car = CarsModel::where('id', $request->id,)->first();
        $image_path = $car->img;  // Value is not URL but directory file path
        // dd($image_path);

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $car->delete();
        return response()->json(['check' => true]);
    }


    public function test(Request $request, Img $Img)
    {
        dd('hello');
        // if ($request->has('multiplePic')) {
        //     foreach ($request->file('multiplePic') as $file) {
        //         $files = [];
        //         dd($file);
        //         $extension = $file->getClientOriginalExtension();
        //         $fileName = time() . '.' . $extension;
        //         $path = 'upload/CarsImages';
        //         dd($file);
        //         $file->move($path, $fileName);
        //     }
        // }

        $input = $request->file('multiplePic');
        $images = array();
        dd($input);
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                dd($file);
                $name = $file->getClientOriginalName();
                $file->move('image', $name);
                $images[] = $name;
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function import(Request $request)
    {
        $importObject = new CarsImport();

        Excel::import($importObject, $request->file('file'));
        $result = $importObject->getResultImport();
        return redirect()->route('cars');
    }
}
