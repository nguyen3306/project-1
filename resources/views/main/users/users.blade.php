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
            @if (count($user) > 0)
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">email</th>
                                <th scope="col">loại tài khoản</th>
                                <th scope="col">Điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Mã giới thiệu</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $item)
                                <tr class="">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>
                                        <span data-value="{{ $item->name }}"
                                            class="editUserName pointer"data-id="{{ $item->id }}">{{ $item->name }}</span>
                                    </td>
                                    <td scope="">{{ $item->email }}</td>
                                    <td>{{ $item->rolename }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->ma_GT }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <button class="btn btn-danger deleteUserbtn"
                                            data-id="{{ $item->id }}">Xóa</button>
                                        {{-- <a href="/detailUser/{{$item->id}}"><button class="btn btn-warning updateUserbtn"
                                        data-id="{{ $item->id }}">Sửa</button> </a> --}}


                                        <a class="btn btn-warning " href="{{route("EditUser",$item->id)}}">Sửa</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- ========================= MODAL ======================= --}}

    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-3 mt-3">
                            Tên
                            <input type="text" name="name" class="form-control" id="UserName"
                                placeholder="Họ và tên">
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
                            <button type="button" class="closemodal btn btn-secondary"
                                data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="submitUser">Thêm</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    @include('main.users.js')
@endsection
