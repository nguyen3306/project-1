<script>
    let defaultUrlObject = `{{ route('exportexcel') }}`

    function excel() {
        $('#excel').click(function(e) {
            e.preventDefault();
            const searchInput = $("input[name=search]").val();
            let urlObject = new URL(defaultUrlObject);
            // console.log(defaultUrlObject,searchInput);
            urlObject.searchParams.append('search', searchInput);
            urlObject.searchParams.append('export_excel', 1);
            window.open(urlObject.href, '_blank').focus();
        });
    }



    $(document).ready(function() {
        excel();
        deleteCar();
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
    });


    function deleteCar() {
        $('.deleteCarbtn').click(function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            console.log(id);
            Swal.fire({
                title: "Xóa xe ?",
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
                        url: "/DeleteCar",
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
