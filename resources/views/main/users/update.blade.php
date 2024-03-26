@extends('layout.Navbar')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
        $(document).ready(function() {
            
        });
    </script>
    <script>
    window.onload = function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        id = localStorage.getItem('id');
        
        $.ajax({
            type: "post",
            url: "/detailUser1",
            data: {
                id: id
            },
            dataType: "json",
            success: function(res) {
                alert('hi');
                console.log(id);

            }
        });
    };
</script>
