@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center mt-4">
        <ul class="pagination pagination-sm shadow-sm bg-white rounded-pill px-2 py-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled mx-1">
                    <span class="page-link rounded-pill px-3">«</span>
                </li>
            @else
                <li class="page-item mx-1">
                    <a class="page-link rounded-pill px-3" href="{{ $paginator->previousPageUrl() }}">«</a>
                </li>
            @endif

            {{-- Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled mx-1">
                        <span class="page-link rounded-pill px-3">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active mx-1">
                                <span class="page-link rounded-pill px-3 bg-primary text-white border-0">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item mx-1">
                                <a class="page-link rounded-pill px-3" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item mx-1">
                    <a class="page-link rounded-pill px-3" href="{{ $paginator->nextPageUrl() }}">»</a>
                </li>
            @else
                <li class="page-item disabled mx-1">
                    <span class="page-link rounded-pill px-3">»</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
