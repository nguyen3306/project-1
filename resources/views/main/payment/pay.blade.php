@extends('layout.Navbar')
@section('Bill')
    HÃY XÁC NHẬN ĐƠN HÀNG
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            <div>
                <form action="{{ route('PayBill') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <input type="text" name="order_id" class="form-control" id="UserId"
                            value="{{ old('name', $oder->id) }}" >
                        Mã khách hàng
                        <input readonly type="text" name="user_id" class="form-control" id="UserName"
                            value="{{ old('name', $oder->user_id) }}">
                        Mã xe
                        <input readonly type="text" name="car_id" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->car_id) }}">
                        Tình trạng
                        <input readonly type="text" name="status" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->status) }}">
                        Số ngày thuê
                        <input readonly type="text" name="rent_day" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->rent_day) }}">
                        Số giờ phát sinh
                        <input readonly type="text" name="extra_hours" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->extra_hours) }}">
                        Mã voucher
                        <input readonly type="text" name="voucher_id" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->voucher_id) }}">
                        Số tiền được giảm
                        <input readonly type="text" name="voucher_value" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->voucher_value) }}">
                        Tổng tiền
                        <input readonly type="text" name="amount" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->amount) }}">
                        Mã tự quản lí
                        <input readonly type="text" name="code" class="form-control" id="UserEmail"
                        value="{{ old('email', $oder->code) }}">
                        
                        <br>
                        <button type="submit" class="btn btn-primary" id="">Xác nhận thanh toán</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        
    </script>


    @include('main.cars.js')
@endsection
