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
                <form action="/UpdateUser" method="post">
                    @csrf
                    <div class="mb-3 mt-3">
                        Tên
                        <input type="text" name="name" class="form-control" id="UserName"
                            value="{{ old('name', $user->name) }}">
                        Email
                        <input type="text" name="email" class="form-control" id="UserEmail"
                        value="{{ old('email', $user->email) }}">
                        Loại tài khản
                        <select name="" class="form-control mb-2" name="Roleid" id="Roleid">
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        Mật khẩu
                        <input type="password" name="password" class="form-control" id="UserPassword"
                        value="{{ old('password', $user->password) }}">
                        +84
                        <input type="text" class="form-control" name="phone" id="UserPhone"
                        value="{{ old('phone', $user->phone) }}"> 
                        Địa chỉ
                        <input type="text" class="form-control" name="address" id="UserPhone"
                        value="{{ old('address', $user->address) }}"> 

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
