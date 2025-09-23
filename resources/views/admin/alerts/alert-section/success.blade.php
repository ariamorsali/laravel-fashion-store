@if (session('alert-section-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="mb-0 right-p">
            {{ session('alert-section-success') }}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
