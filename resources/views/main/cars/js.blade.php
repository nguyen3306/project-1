<script>
    let defaultUrlObject = `{{route('exportexcel')}}`
    function excel() {
        $('#excel').click(function (e) { 
            e.preventDefault();
            const searchInput = $("input[name=search]").val();
            let urlObject = new URL(defaultUrlObject);
            // console.log(defaultUrlObject,searchInput);
            urlObject.searchParams.append('search', searchInput);
            urlObject.searchParams.append('export_excel', 1);
                window.open(urlObject.href, '_blank').focus();
        });
    }



    $(document).ready(function () {
        excel();
        detail();
    });


    function detail() {
        $('.Detail').click(function (e) { 
            $('#editFormId').val($(this).attr('data-id'));
            e.preventDefault();
            var id = $("#editFormId").val().trim();
            let url = `/${id}/Detail`;
            console.log(url);
            window.location.href(`/${id}/updateUser`);
        });
    }
</script>