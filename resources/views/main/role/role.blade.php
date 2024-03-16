@extends('layout.Navbar')
@extends('main.role.js')
@section('Category')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm
    </button>
@endsection
<!-- Button trigger modal -->
@section('main')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm loại tài khoản</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="addRole" name="addRole"
                        placeholder="Nhập loại tài khoản">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="addRolebtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @if (count($role) > 0)
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
                            @foreach ($role as $key => $item)
                                <tr data-toggle="modal" data-target="#editModal" class="Rolename"
                                    data-id="{{ $item->id }}" data-value="{{ $item->name }}">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>
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
                                        <button class="btn btn-danger deleteRolebtn"
                                            data-id="{{ $item->id }}">Xóa</button>
                                        <button class="btn btn-warning editRolebtn"
                                            data-id="{{ $item->id }}">Sửa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            addRole();
            deleteRole();
        });



        function addRole() {
            $('#addRolebtn').click(function(e) {
                var role = $('#addRole').val().trim();
                e.preventDefault();
                console.log(role);
                $.ajax({
                    type: "post",
                    url: "/createRole",
                    data: {
                        role: role
                    },
                    dataType: "json",
                    success: function(res) {
                        Swal.fire({
                            title: "thêm thành công",
                            text: "",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
            });
        }



        function deleteRole() {
            $('.deleteRolebtn').click(function(e) {
                e.preventDefault();
                id = $(this).attr('data-id');
                console.log(id);
                Swal.fire({
                    title: "Xóa loại tài khoản?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Đúng",
                    denyButtonText: `không`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/deleteRole",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                Swal.fire("Xóa thành công!", "", "success");

                            }.then(() => {
                                window.location.reload()
                            })
                        })
                    } else if (result.isDenied) {
                        Swal.fire("Đã hủy", "", "info");
                    }
                });
            });

        }
    </script>
@endsection
