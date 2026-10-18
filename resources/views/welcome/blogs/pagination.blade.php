@if ($paginator->hasPages())
<nav class="tx-pagination">
    @unless ($paginator->onFirstPage())
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></a>
    @endunless

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="disabled">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></a>
    @endif
</nav>
@endif
