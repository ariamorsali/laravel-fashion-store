@if (session('alert-section-warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p class="mb-0 right-p">
            {{ session('alert-section-warning') }}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif