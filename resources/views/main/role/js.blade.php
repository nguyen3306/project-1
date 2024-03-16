@section('js')
<script>

    $(document).ready(function () {
        alert();
    });

    function alert() {
        $('#test').click(function (e) { 
            e.preventDefault();
            console.log('hi');;
            
        });
    }
</script>
@endsection