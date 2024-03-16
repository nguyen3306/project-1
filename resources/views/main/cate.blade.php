@extends('layout.Navbar')
@section('Category')
    <button type="submit" class="btn btn-primary" id="addCate">Thêm</button>
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
                                    <button class="btn btn-danger deleteCatebtn"
                                            data-id="{{ $item->id }}">Xóa
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

    <div class="modal fade" id="Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3 mt-3">
                            <input type="text" class="form-control addCate" id="addCate" name="addCate"
                                   placeholder="Nhập thông tin">
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



    <div class="modal fade" id="editModal" tabindex="-1"
         data-bs-backdrop="" data-bs-keyboard="false"
         role="dialog"
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
                                   hidden=""
                                   value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="closemodalCate btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="confirm" >Thêm</button>
                </div>
            </div>
        </div>
    </div>






    <script>
        $(document).ready(function () {
            addCate();
            deleteCate();
            UpdateCate();
            // closeModal();
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        function addCate() {
            $('#addCate').click(function (e) {
                e.preventDefault();
                $('#Modal').modal('show');
            });
            $('#submitbtn').on('click', function (e) {
                e.preventDefault();
                var cate = $('.addCate').val().trim();
                console.log('cate: ', cate)
                $.ajax({
                    type: "post",
                    url: "/addcate",
                    data: {
                        cate: cate
                    },
                    dataType: "json",
                    success: function (res) {
                        console.log(res);
                        if (res.check == true) {
                            Toast.fire({
                                icon: "success",
                                title: "thêm loại xe thành công"
                            })
                                .then(() => {
                                    window.location.reload();
                                })
                        }
                    },
                    error: function (data) {
                        Toast.fire({
                            icon: "error",
                            title: data.responseJSON.message
                        });
                    }
                });
            });
        }

        function deleteCate() {
            $('.deleteCatebtn').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: "Xóa dữ liệu ?",
                    text: "Hành động này không thể hoàn tác",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: 'Không',
                    confirmButtonText: "Xóa!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: "/deleteCate",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function (res) {
                                if (res.check == true) {
                                    Swal.fire({
                                        title: "Đã xóa thành công",
                                        text: "",
                                        icon: "success"
                                    }).then(() => {
                                        window.location.reload()
                                    });
                                }

                            },
                            error: function (data) {
                                Toast.fire({
                                    icon: "error",
                                    title: data.responseJSON.message
                                });
                            }
                        });

                    }
                });

            });
        }

        function UpdateCate() {
            $(document).on('click', '.editCateName', function () {
                $('#editForm').val($(this).attr('data-value'));
                $('#editFormId').val($(this).attr('data-id'));
                // $('#editModal').modal('show');
                console.log('aaaaa');
            });

            $('.modal-footer').on('click', '#confirm', function () {
                var id = $("#editFormId").val().trim();
                let url_ = `/${id}/updateCate`;
                var newCate = $("#editForm").val().trim();
                console.log('id: ', id)
                console.log('newCate: ', newCate)
                $.ajax({
                    type: "post",
                    url: url_,
                    data: {
                        cate: newCate
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.check == true) {
                            Swal.fire({
                                title: "Chỉnh sửa thành công",
                                text: "",
                                icon: "success"
                            })
                                .then(() => {
                                    window.location.reload()
                                });
                        } else {
                            Swal.fire({
                                title: "Chỉnh sửa thành công",
                                text: "",
                                icon: "success"
                            })
                        }
                    }
                });
            });
        }
        // function closeModal() {
        //     $('.closemodal').click(function (e) {
        //         e.preventDefault();
        //         $('#addCate').val('');
        //     });
        // }
    </script>
    </html>
@endsection
