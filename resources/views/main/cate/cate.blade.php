@extends('layout.Navbar')
@section('Category')
<div class="col-3">
    <button type="submit" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addCateModal">Thêm</button>
    <button id="excel" class="btn btn-primary">download</button>
    <input type="text"name="search">
</div>
@endsection
@section('Cate')
    HÃNG XE CÁC LOẠI
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            @if (count($cate) > 0)
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên loại</th>
                                {{-- <th scope="col">Status</th> --}}
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cate as $key => $item)
                                <tr>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td data-toggle="modal" data-target="#editModal" class="editCateName pointer"
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
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <button class="btn btn-danger deleteCatebtn" data-id="{{ $item->id }}">Xóa
                                        </button>
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

    <div class="modal fade" id="addCateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm hãng xe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/addcate" method="POST">
                        @csrf
                        <div class="mb-3 mt-3">
                            <input type="text" class="form-control addCate" id="addCate" name="addCate"
                                placeholder="Nhập thông tin" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="closemodal btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" id="submitbtn">Thêm</button>
                </form>

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
    @include('main.cate.js')
@endsection
