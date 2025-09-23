<script>
    $(document).ready(function() {
        var className = '{{ $className }}'
        var element = $('.' + className);

        element.on('click', function(e) {
            e.preventDefault();
            const swalWithBootstrapButton = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2', // دکمه تایید سبز
                    cancelButton: 'btn btn-danger mx-2', // دکمه لغو قرمز
                    popup: 'custom-swal-popup' // کلاس سفارشی برای پنجره SweetAlert
                },
                buttonStyling: false
            });
            swalWithBootstrapButton.fire({
                title: "Do you want to delete the data?",
                text: "This operation is irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "cancel",
                timer: 25000,
                toast: true,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        })
    });
</script>
