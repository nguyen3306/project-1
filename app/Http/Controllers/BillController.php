<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oders;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $oder = Oders::where('id', $id)->first();
        // dd($oder);
        return view('main.payment.pay', compact('oder'),);
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
    public function show($id,Request $request,Bill $bill)
    {
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $bill = Oders::where('id', $request->order_id)->first();

        // dd($bill);
        $data = [
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'rent_day' => $request->rent_day,
            'extra_hours' => $request->extra_hours,
            'amount' => $request->amount,
            'voucher_id' => $request->voucher_id,
            'voucher_value' => $request->voucher_value,
            'order_id' => $request->order_id,
            'code' => $request->code,
        ];
        $bills = Bill::where('id', $request->id)->create($data);
        // dd($bill);
        $oder = Oders::where('id',$request->order_id)->delete();
        

        return redirect('/cate')->with('success' , 'Thanh toán thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
