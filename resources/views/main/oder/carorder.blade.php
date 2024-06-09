@extends('layout.Navbar')
@section('carorder')
    ĐẶT XE
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            <div>
                <form action="{{ route('AddtoCart') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">

                        Tên xe
                        <input type="text" name="" class="form-control" id="UserName"
                            value="{{ old('name', $car->name ?? '') }}">
                        ghế ngồi
                        <input type="text" name="" class="form-control" id="UserEmail"
                            value="{{ old('email', $car->seat ?? '') }}">
                        đời xe
                        <input type="text" name="" class="form-control" id="UserEmail"
                            value="{{ old('email', $car->date ?? '') }}">
                        mô tả xe
                        <input type="text" name="" class="form-control" id="UserEmail"
                            value="{{ old('email', $car->description ?? '') }}">
                        giá thuê
                        <input type="text" name="" class="form-control" id="UserEmail"
                            value="{{ old('email', $car->price ?? '') }}">
                        Hãng xe
                        <input type="text" name="" class="form-control" id="UserEmail"
                            value="{{ old('email', $car->brand ?? '') }}">
                        Mã xe
                        <input type="text" name="car_id" class="form-control" id="UserId"
                            value="{{ old('email', $car->id ?? '') }}">
                        Mã người thuê
                        <input type="text" name="user_id" class="form-control" id="UserEmail">
                        Tình trạng
                        <input type="text" name="status" class="form-control" id="UserEmail">
                        Số ngày thuê
                        <input type="text" name="rent_day" class="form-control" id="UserEmail">
                        Số giờ phát sinh
                        <input type="text" name="extra_hours" class="form-control" id="UserEmail">
                        Mã voucher
                        <input type="text" name="voucher_id" class="form-control" id="UserEmail">
                        Số tiền được giảm
                        <input type="text" name="voucher_value" class="form-control" id="UserEmail">
                        Tình trạng thanh toán
                        <input type="text" name="paystatus" class="form-control" id="UserEmail">
                        Tổng cộng
                        <input type="text" name="amount" class="form-control" id="UserEmail">
                        Mã đơn tự quản lí
                        <input type="text" name="code" class="form-control" id="UserEmail">

                    </div>
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>

        <script></script>


        @include('main.cars.js')
    @endsection
