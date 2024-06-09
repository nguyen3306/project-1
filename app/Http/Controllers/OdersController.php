<?php

namespace App\Http\Controllers;

use App\Models\Oders;
use App\Models\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;

class OdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $oder = Oders::all();
        // dd($oder);
        return view('main.oder.oder',compact('oder'));
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
        $data = [
            'user_id' => $request->userID,
            'car_id' => $request->car_id,
            'status' => $request->status,
            'rent_day' => $request->rent_day,
            'extra_hours' => $request->extraHour,
            'voucher_id' => $request->codeVoucher,
            'voucher_value' => $request->discountPrice,
            'payment_status' => $request->paystatus,
            'amount' => $request->total,
            'code' => $request->code,
        ];
        Oders::create($data);
        return redirect('/cars')->with('success', 'thêm vào giỏ hàng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Oders $oders, Request $request)
    {

        $oder = Oders::where('user_id', $request->id)->get();
        // $oder = Oders::all();
        // $oder = $request->id;
        // dd($oder);
        return view("main.oder.show" , compact('oder'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oders $oders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oders $oders)
    {
        $oder = $request->all();
        // dd($oder);
        Oders::create($oder);
        return redirect('/cars')->with('success','Thêm vào giỏ hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Oders $oders)
    {
        $Oder = Oders::where('id',$request->id)->first();
        // dd($Oder);
        if (empty($Oder)) {
            return response()->json(['check' => false]);
        }
        Oders::where('id',$request->id)->delete();
        return response()->json(['check' => true]);
    }
}
