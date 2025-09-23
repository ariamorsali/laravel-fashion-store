@if(session('toast-error'))
    <section class="toast" data-delay="5000">
        <section class="toast-body py-3 d-flex bg-error text-white">
            <p class="ml-auto my-1">{{ session('toast-error') }}</p>
            <button type="button" class="mr-2 text-white mb-0 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </section>
    </section>

    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        })
    </script>
@endif
