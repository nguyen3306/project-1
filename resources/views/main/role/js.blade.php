<script>
    $(document).ready(function() {
        addRole();
        deleteRole();
        editRole();

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
            Swal.fire({
                title: "Xóa loại tài khoản?",
                showDenyButton: true,
                showCancelButton: false,
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

                        }
                    }).then(() => {
                        window.location.reload()
                    })
                } else if (result.isDenied) {
                    Swal.fire("Đã hủy", "", "info");
                }
            });
        });

    }


    function editRole() {
        $('.roleName').click(function(e) {
            e.preventDefault();
            $('#editRole').val($(this).attr('data-value'));
            $('#editRoleId').val($(this).attr('data-id'));
            role = $('#editRoleId').val().trim();
            role2 = $('#editRole').val().trim();


            console.log(role);
            $('#modalEditRole').modal('show');

            $('#confirm').click(function(e) {
                e.preventDefault();
                var newRole = $('#editRole').val().trim();
                var id = $('#editRoleId').val().trim();
                url = `/${id}/updateRole`;

                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        role:newRole
                    },
                    dataType: "json",
                    success: function (res) {
                        Swal.fire({
                        title: "cập nhật thành công",
                        text: "",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    });
                    }
                });

            });


        });
    }
</script>
