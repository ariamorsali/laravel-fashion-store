@if (session('swal-success'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "The operation was successful",
                text: "{{session('swal-success')}}",
                icon: 'success',
                confirmButtonText:'ok',
            });
        });
    </script>
@endif
