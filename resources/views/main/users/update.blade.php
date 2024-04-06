@extends('layout.Navbar')
@section('user')
    <button type="submit" class="btn btn-primary" id="userModalbtn">Thêm</button>
@endsection
@section('Users')
    TÀI KHOẢN
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            <div>
                <form action="" method="post">
                    @csrf
                    <div class="mb-3 mt-3">
                        Tên
                        <input type="text" name="name" class="form-control" id="UserName" placeholder="Họ và tên"
                            value="{{ old('name', $user->name) }}">
                        Email
                        <input type="text" name="email" class="form-control" id="UserEmail"
                            placeholder="vd: exam@gmail.com">
                        Loại tài khản
                        <select name="" class="form-control mb-2" name="Roleid" id="Roleid">
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        Mật khẩu
                        <input type="password" name="password" class="form-control" id="UserPassword"
                            placeholder="Chữ và số">
                        Nhập lại Mật khẩu
                        <input type="password" name="password" class="form-control" id="UserPassword2"
                            placeholder="Nhập lại mật khẩu">
                        +84
                        <input type="text" class="form-control" name="" id="UserPhone"
                            placeholder="Số điện thoại"> Địa chỉ
                        <input type="text" class="form-control" id="UserAddress" placeholder="Địa chỉ"> Mã giới thiệu
                        <input type="text" class="form-control" id="UsermaGT" placeholder="Mã giới thiệu">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="closemodal btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="submitUser">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @include('main.users.js')
@endsection
