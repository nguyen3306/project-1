<script>
    $(document).ready(function() {
        // addCate();
        deleteCate();
        UpdateCate();
        
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
        $('#submitbtn').on('click', function(e) {
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

    function deleteCate() {
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
                        url: "/deleteCate",
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
        $(document).on('click', '.editCateName', function() {
            $('#editForm').val($(this).attr('data-value'));
            $('#editFormId').val($(this).attr('data-id'));
            // $('#editModal').modal('show');
        });

        $('.modal-footer').on('click', '#confirm', function() {
            var id = $("#editFormId").val().trim();
            let url_ = `/${id}/updateCate`;
            var newCate = $("#editForm").val().trim();
            $.ajax({
                type: "post",
                url: url_,
                data: {
                    cate: newCate
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
        });
    }
    // function closeModal() {
    //     $('.closemodal').click(function (e) {
    //         e.preventDefault();
    //         $('#addCate').val('');
    //     });
    // }
</script>
