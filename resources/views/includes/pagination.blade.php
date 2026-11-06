@if ($paginator->hasPages())
    <div id="pagination-container"
        style="padding: 15px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #D6D8DA; width: 100%;">
        <div>
            <span class="font_13_gray" id="pagination-info">
                @if ($paginator->total() > 0)
                    Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
                @else
                    No entries found
                @endif
            </span>
        </div>
        <div id="pagination-controls" style="display: flex; gap: 5px; align-items: center;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="gray_button" disabled>Previous</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="gray_button" style="text-decoration: none; display: inline-block;">Previous</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="font_13_gray" style="padding: 0 5px;">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="green_button" style="min-width: 35px; border: none;">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="gray_button" style="text-decoration: none; min-width: 35px; text-align: center; display: inline-block;">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="gray_button" style="text-decoration: none; display: inline-block;">Next</a>
            @else
                <button class="gray_button" disabled>Next</button>
            @endif
        </div>
    </div>
@endif
