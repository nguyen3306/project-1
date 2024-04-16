@extends('layout.Navbar')
@section('cars')

    <form action="/importcars" method="post"  enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="" placeholder=""/>
        <button class="btn btn-primary mt-1" type="submit" id="submit">Import</button>
    <button class="btn btn-primary mt-1" type="button" id="" data-bs-toggle="modal" data-bs-target="#ModalCar">Thêm</button>

    </form>

@endsection
@section('cartitle')
    CHI TIẾT XE 
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            @if (count($cars) > 0)
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên loại</th>
                                {{-- <th scope="col">Status</th> --}}
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $key => $item)
                                <tr>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td  class=""
                                        data-id="{{ $item->id }}" data-value="{{ $item->name }}">
                                        {{ $item->name }}
                                    </td>
                                    {{-- <td>
                                    <select name="" id="" class="form-control switchRole pointer"
                                        data-id="{{ $item->id }}">
                                        @if ($item->status == 0)
                                            <option value="0" selected>Đang khóa</option>
                                            <option value="1">Đang mở</option>
                                        @else
                                            <option value="0">Đang khóa</option>
                                            <option value="1" selected>Đang mở</option>
                                        @endif
                                    </select>
                                </td> --}}
                                    <td>
                                        <button class="btn btn-danger deleteCatebtn" data-id="{{ $item->id }}">Xóa
                                        </button>
                                        <button data-toggle="modal" data-target="#editModal" class="btn btn-warning">Sửa</button>
                                        <button data-id="{{ $item->id }}" class="btn btn-primary Detail">Chi tiết</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    {{-- ================================== --}}

    <!-- Modal -->

    <div class="modal fade" id="ModalCar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Thêm thông tin xe
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3 mt-3">
                            nhập tên
                            <input type="text" class="form-control" id="" placeholder="Nhập thông tin">
                            tên
                            <input type="text" class="form-control" id="" placeholder="Nhập thông tin">
                            <input type="text" class="form-control" id="" placeholder="Nhập thông tin">
                            <input type="text" class="form-control" id="" placeholder="Nhập thông tin">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="closemodal btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitbtn">Thêm</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="" data-bs-keyboard="false" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Hãy nhập tên mới</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3 mt-3">
                            <input type="text" class="form-control" id="editForm" placeholder="Nhập thông tin"
                                value="">
                            <input type="text" class="form-control" id="editFormId" placeholder="Nhập thông tin"
                                hidden="" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="closemodalCate btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="confirm">Thêm</button>
                </div>
            </div>
        </div>
    </div>







    </html>
@include('main.cars.js')

@endsection
