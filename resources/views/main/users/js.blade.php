<script>
    $(document).ready(function() {
        addUser();
        deleteUser();
        updateUser();
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


    function addUser() {
        $('#userModalbtn').click(function(e) {
            e.preventDefault();
            $('#addUserModal').modal('show');
            $('#submitUser').click(function(e) {
                var name = $('#UserName').val().trim();
                var role = $('#Roleid option:selected').val();
                var email = $('#UserEmail').val().trim();
                var password = $('#UserPassword').val().trim();
                var password2 = $('#UserPassword2').val().trim();
                var phone = $('#UserPhone').val().trim();
                var address = $('#UserAddress').val().trim();
                var maGT = $('#UsermaGT').val().trim();
                e.preventDefault();
                if (password2 && password2 == password) {
                    $.ajax({
                        type: "post",
                        url: "/CreateUser",
                        data: {
                            name: name,
                            role: role,
                            phone: phone,
                            email: email,
                            password: password,
                            address: address,
                            maGT: maGT
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
                } else {
                    alert('mật khẩu chưa trùng nhau');
                }
            });
        });
    }


    function deleteUser() {
        $('.deleteUserbtn').click(function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            console.log(id);
            Swal.fire({
                title: "Xóa user ?",
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
                        type: "post",
                        url: "/DeleteUser",
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


    

</script>
