@extends('layout.Navbar')
@section('Oder')
    <div class="col-3">
        <button type="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCateModal">Thêm</button>
        <button id="excel" class="btn btn-primary">download</button>
        <input type="text"name="search">
    </div>
@endsection
@section('oder')
    CÁC ĐƠN ĐẶT
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">stt</th>
                                <th scope="col">mã người thuê</th>
                                <th scope="col">mã xe</th>
                                <th scope="col">trạng thái</th>
                                <th scope="col">số ngày thuê</th>
                                <th scope="col">giờ phát sinh</th>
                                <th scope="col">mã voucher</th>
                                <th scope="col">số tiền được giảm</th>
                                <th scope="col">trạng thái thanh toán</th>
                                <th scope="col">tổng tiền</th>
                                <th scope="col">mã tự quản lí</th>
                                <th scope="col">ngày tạo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oder as $key => $item)
                                <tr>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td class="" data-id="{{ $item->id ?? '' }}" hidden>
                                    </td>
                                    <td scope="row">{{ $item->user_id ?? '' }}</td>
                                    <td scope="row">{{ $item->car_id ?? '' }}</td>
                                    <td scope="row">{{ $item->status ?? '' }}</td>
                                    <td scope="row">{{ $item->rent_day ?? '' }}</td>
                                    <td scope="row">{{ $item->extra_hours ?? '' }}</td>
                                    <td scope="row">{{ $item->voucher_id ?? '' }}</td>
                                    <td scope="row">{{ $item->voucher_value ?? '' }}</td>
                                    <td scope="row">{{ $item->payment_status ?? '' }}</td>
                                    <td scope="row">{{ $item->amount ?? '' }}</td>
                                    <td scope="row">{{ $item->code ?? '' }}</td>
                                    <td scope="row">{{ $item->created_at ?? '' }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("getBill",$item->id ?? '')}}">Thanh toán
                                        </a>
                                        <button class="btn btn-danger deleteOderbtn" data-id="{{ $item->id ?? '' }}">Xóa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    {{-- ================================== --}}

    <!-- Modal -->
    </html>
    @include('main.oder.js')
@endsection
