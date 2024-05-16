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
        // addCar();
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

    // function addCar() {
    //     $('#addCarbtn').click(function(e) {
    //         console.log('hi');
    //         var name = $('#name').val().trim();
    //         var category = $('#category option:selected').val();
    //         var brand = $('#brand').val().trim();
    //         var seat = $('#seat').val().trim();
    //         var date = $('#date').val().trim();
    //         var description = $('#description').val().trim();
    //         var price = $('#price').val().trim();
    //         var image = $('#image').val().trim();
    //         e.preventDefault();
    //         $.ajax({
    //             type: "post",
    //             url: "/createCar",
    //             data: {
    //                 name: name,
    //                 category: category,
    //                 brand: brand,
    //                 seat: seat,
    //                 date: date,
    //                 description: description,
    //                 price: price,
    //                 image: image,
    //             },
    //             dataType: "json",
    //             success: function(res) {
    //                 if (res.check == true) {
    //                     Toast.fire({
    //                             icon: "success",
    //                             title: "thêm xe thành công"
    //                         })
    //                         .then(() => {
    //                             window.location.reload();
    //                         })
    //                 } else {
    //                     Toast.fire({
    //                         icon: "error",
    //                         title: data.responseJSON.message
    //                     })
    //                 }

    //             },
    //         });
    //     });
    // }

    function deleteCar() {
        $('.deleteCarbtn').click(function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            path = $(this)
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
