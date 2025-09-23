@if (session('swal-error'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "error",
                text: "{{session('swal-error')}}",
                icon: 'error',
                confirmButtonText: 'pk',
            });
        });
    </script>
@endif
