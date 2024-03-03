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
                                <th scope="col">loại tài khoản</th>
                                <th scope="col">tài khoản</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $item)
                                <tr class="">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>
                                        <span class="editCateName pointer" data-id="{{ $item->id }}"
                                            value-data="{{ $item->name }}">{{ $item->name }}</span>
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
                    <form action="/action_page.php">
                        <div class="mb-3 mt-3">
                            Tên
                            <input type="text" class="form-control" id="UserName" placeholder="Họ và tên">
                            Email
                            <input type="text" class="form-control" id="UserEmail" placeholder="vd: exam@gmail.com">
                            Mật khẩu
                            <input type="text" class="form-control" id="UserPassword" placeholder="Chữ và số">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="closemodal btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitUser">Thêm</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            addUser();
        });



        function addUser() {
            $('#userModalbtn').click(function(e) {
                e.preventDefault();
                $('#addUserModal').modal('show');
                
                $('#submitUser').click(function(e) {
                    var name = $('#UserName').val().trim();
                var Roleid = ('1');
                var email = $('#UserEmail').val().trim();
                var password = $('#UserPassword').val().trim();
                    console.log(name);
                    console.log(email);
                    console.log(password);
                    e.preventDefault();
                    $.ajax({
                        type: "post",
                        url: "/api/CreateUser",
                        data: {
                            name: name,
                            Roleid: Roleid,
                            // phone: ,
                            email: email,
                            password: password
                        },
                        dataType: "json",
                        success: function(res) {
                            Toast.fire({
                                    icon: "success",
                                    title: "thêm tài khoản thành công"
                                })
                                .then(() => {
                                    window.location.reload();
                                })
                        },
                        error: function(data) {
                            Toast.fire({
                                icon: "error",
                                title: data.responseJSON.message
                            })
                        }
                    });
                });


            });
        }
    </script>
@endsection
