<div class="pagination pagination2 text-center d-flex justify-content-center align-items-center">
    <div class="d-flex">
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled"><img src="{{ asset('public/images/chevron_back.svg')}}" alt="" class="chevron_back"></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><img src="{{ asset('public/images/chevron_back.svg')}}" alt="" class="chevron_back"></a>
        @endif

        @if ($paginator->currentPage() > 2)
            <span class="mx-3"><a href="{{ $paginator->url(1) }}">1</a></span>
        @endif

    
        @if ($paginator->currentPage() > 1)
            <span class="mx-3"><a href="{{ $paginator->url($paginator->currentPage() - 1) }}">{{ $paginator->currentPage() - 1 }}</a></span>
        @endif

        <span class="mx-3 firstspan current-page">{{ $paginator->currentPage() }}</span>

        @if ($paginator->hasMorePages())
            <span class="mx-3 firstspan current-page"><a href="{{ $paginator->nextPageUrl() }}">{{ $paginator->currentPage() + 1 }}</a></span>
        @endif

       

        @if ($paginator->currentPage() + 1 < $paginator->lastPage())
            <span class="mx-3"><a href="{{ $paginator->url($paginator->currentPage() + 1) }}">{{ $paginator->currentPage() + 1 }}</a></span>
        @endif

        @if ($paginator->currentPage() < $paginator->lastPage())
            <span class="mx-3"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></span>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><img src="{{ asset('public/images/chevron_forward.svg')}}" alt=""></a>
        @else
            <a href="#" class="disabled"><img src="{{ asset('public/images/chevron_forward.svg')}}" alt=""></a>
        @endif
    </div>
</div>
