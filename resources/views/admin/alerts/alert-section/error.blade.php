@if (session('alert-section-error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p class="mb-0 right-p">
            {{ session('alert-section-error') }}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif