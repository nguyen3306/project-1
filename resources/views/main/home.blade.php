@extends('layout.Navbar')
@section('main')

    <div class="container">
        <input type="text" placeholder="category" id="catename">
        <button class="submit">submit</button>
    </div>
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
                                <th scope="col">Status</th>
                                <th scope="col">Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cate as $key => $item)
                                <tr class="">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>
                                        <span class="editCateName pointer"
                                            data-id="{{ $item->id }}">{{ $item->name }}</span>
                                    </td>
                                    <td>
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
                                    </td>
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




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            addCate();
            deleteRole();
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        function addCate() {
            $('.submit').click(function(e) {
                e.preventDefault();
                var cate = $('#catename').val().trim();
                if (cate == '') {

                    Swal.fire({
                        title: 'Error!',
                        text: 'cate is empty',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                } else {
                    console.log(cate);
                    $.ajax({
                        type: "post",
                        url: "/api/addcate",
                        data: {
                            cate: cate
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res.check == true) {
                                Toast.fire({
                                        icon: "success",
                                        title: "thêm loại xe thành công"
                                    })
                                    .then(() => {
                                        window.location.replace('/');
                                    })
                            } else if (res.msg.cate) {
                                Toast.fire({
                                    icon: "error",
                                    title: res.msg.cate
                                });
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: res.msg
                                });
                            }
                        }
                    });
                }
            });
        }

        function deleteRole() {
            $('.deleteCatebtn').click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "/api/deleteCate",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        if (res.check == true) {
                            Swal.fire({
                                title: 'Thành công',
                                text: 'Đã xóa loại xe',
                                icon: 'success',
                                confirmButtonText: 'xác nhận'
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: 'Xóa thất bại',
                                text: res.msg,
                                icon: 'error',
                                confirmButtonText: 'Cool'
                            })
                        }

                    }
                });
            });
        }
    </script>

    </html>

@endsection
