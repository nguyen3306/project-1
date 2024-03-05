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
                                <tr class="">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>
                                        <span class="editCateName pointer" data-id="{{ $item->id }}"
                                            value-data="{{ $item->name }}">{{ $item->name }}</span>
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
                                            data-id="{{ $item->id }}">Xóa</button>
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
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#editModal">
        Launch
    </button> --}}

    <!-- Modal -->

    <div class="modal fade" id="Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm thông tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/action_page.php">
                        <div class="mb-3 mt-3">
                            <input type="text" class="form-control" id="addCate" placeholder="Nhập thông tin">
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



    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hãy nhập tên mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/action_page.php">
                        <div class="mb-3 mt-3">
                            <input type="text" class="form-control" id="editForm" placeholder="Nhập thông tin"
                                value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="closemodalCate btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="confirm">Thêm</button>
                </div>
            </div>
        </div>
    </div>






    <script>
        $(document).ready(function() {
            addCate();
            deleteRole();
            UpdateCate();
            closeModal();
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
            $('#addCate').click(function(e) {
                e.preventDefault();
                $('#Modal').modal('show');
            });
            $('#submitbtn').click(function(e) {
                e.preventDefault();
                var cate = $('#addCate').val().trim();
                $.ajax({
                    type: "post",
                    url: "/api/addcate",
                    data: {
                        cate: cate
                    },
                    dataType: "json",
                    success: function(res) {
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
                    error: function(data) {
                        Toast.fire({
                            icon: "error",
                            title: data.responseJSON.message
                        });
                    }
                });
            });
        }

        function deleteRole() {
            $('.deleteCatebtn').click(function(e) {
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
                            url: "/api/deleteCate",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function(res) {
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
                            error: function(data) {
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
            $('.editCateName').click(function(e) {
                e.preventDefault();
                $('#editModal').modal('show');

                // $('#confirm').click(function(e) {

                    // e.stopPropagation();
                    // e.stopImmediatePropagation();
                    e.preventDefault();
                    $('editForm').val('');
                    var id = $(this).attr('data-id');
                    console.log(id);
                    var Cate = $(this).attr('value-data');
                    $('#editForm').val(Cate);
                    console.log(Cate);
                    var newCate = $('#editForm').val().trim();
                    console.log(newCate);
                    let url_ = `/api/${id}/updateCate`;
                    console.log(url_);
                    $.ajax({
                        type: "post",
                        url: url_,
                        data: {
                            newCate: newCate
                        },
                        dataType: "json",
                        success: function(res) {
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
                // });
                
            });
        }

        // function closeModal() {
        //     $('.closemodalCate').click(function(e) {
        //         e.preventDefault();
        //         $('#editForm').val('');
        //         // var id = '';
        //     });
        // }

        function closeModal() {
            $('.closemodal').click(function(e) {
                e.preventDefault();
                $('#addCate').val('');
            });
        }
    </script>

    </html>

@endsection
