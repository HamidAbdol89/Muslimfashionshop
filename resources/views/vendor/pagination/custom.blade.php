@if ($sliders->hasPages())
    <ul class="pagination">
        {{-- Nút Previous --}}
        @if ($sliders->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $sliders->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Các nút số trang --}}
        @foreach ($sliders->links() as $element)
            {{-- Dấu "..." khi có nhiều trang --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Các số trang --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $sliders->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Nút Next --}}
        @if ($sliders->hasMorePages())
            <li><a href="{{ $sliders->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
