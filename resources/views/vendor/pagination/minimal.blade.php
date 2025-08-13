@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-center gap-1 py-6 text-sm">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded border border-white/10 text-white/40 cursor-default">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 rounded border border-white/10 hover:bg-white/5">‹</a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-white/40">…</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded bg-white/10 border border-white/10">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 rounded border border-white/10 hover:bg-white/5">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded border border-white/10 hover:bg-white/5">›</a>
        @else
            <span class="px-3 py-1 rounded border border-white/10 text-white/40 cursor-default">›</span>
        @endif
    </nav>
@endif