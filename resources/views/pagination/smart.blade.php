@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between py-4">
        <!-- Page Info -->
        <div class="text-sm text-gray-600">
            Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-gray-400 text-sm cursor-not-allowed">← Sebelumnya</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}&per_page={{ request('per_page', 10) }}" class="px-3 py-2 text-blue-600 hover:bg-blue-50 rounded text-sm transition">← Sebelumnya</a>
            @endif

            <!-- Page Numbers -->
            <div class="flex items-center gap-1">
                @php
                    $start = max($paginator->currentPage() - 2, 1);
                    $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
                    
                    if ($end - $start < 4) {
                        if ($start == 1) {
                            $end = min(5, $paginator->lastPage());
                        } else {
                            $start = max(1, $end - 4);
                        }
                    }
                @endphp

                {{-- Show first page if not in range --}}
                @if ($start > 1)
                    <a href="{{ $paginator->url(1) }}&per_page={{ request('per_page', 10) }}" class="px-2 py-2 text-gray-700 hover:bg-gray-100 rounded text-sm">1</a>
                    @if ($start > 2)
                        <span class="px-1 text-gray-400">...</span>
                    @endif
                @endif

                {{-- Page Links --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 bg-blue-600 text-white rounded text-sm font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $paginator->url($page) }}&per_page={{ request('per_page', 10) }}" class="px-3 py-2 text-gray-700 hover:bg-gray-100 rounded text-sm">{{ $page }}</a>
                    @endif
                @endfor

                {{-- Show last page if not in range --}}
                @if ($end < $paginator->lastPage())
                    @if ($end < $paginator->lastPage() - 1)
                        <span class="px-1 text-gray-400">...</span>
                    @endif
                    <a href="{{ $paginator->url($paginator->lastPage()) }}&per_page={{ request('per_page', 10) }}" class="px-2 py-2 text-gray-700 hover:bg-gray-100 rounded text-sm">{{ $paginator->lastPage() }}</a>
                @endif
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}&per_page={{ request('per_page', 10) }}" class="px-3 py-2 text-blue-600 hover:bg-blue-50 rounded text-sm transition">Selanjutnya →</a>
            @else
                <span class="px-3 py-2 text-gray-400 text-sm cursor-not-allowed">Selanjutnya →</span>
            @endif
        </div>
    </nav>
@endif
