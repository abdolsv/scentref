{{-- resources/views/components/perfume-grid.blade.php
     Used by FilterController::handle() to render AJAX partial.
     Receives: $perfumes  (LengthAwarePaginator)
--}}
@if($perfumes->isEmpty())
    <div class="col-span-full py-20 text-center">
        <p class="font-display text-2xl text-ash mb-3">No perfumes found</p>
        <p class="text-ash text-sm">Try adjusting your filters or search terms.</p>
    </div>
@else
    {{-- Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($perfumes as $perfume)
            <x-perfume-card :perfume="$perfume" />
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($perfumes->hasPages())
    <div class="mt-10 flex justify-center">
        <nav class="flex items-center gap-1" role="navigation" aria-label="Pagination">

            {{-- Previous --}}
            @if($perfumes->onFirstPage())
                <span class="px-3 py-2 text-ash text-sm cursor-not-allowed">←</span>
            @else
                <button
                    @click="filters.page = {{ $perfumes->currentPage() - 1 }}; applyFilters()"
                    class="px-3 py-2 text-ink hover:text-gold text-sm transition-colors"
                >←</button>
            @endif

            {{-- Page numbers --}}
            @for($p = 1; $p <= $perfumes->lastPage(); $p++)
                @if($p == $perfumes->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center bg-gold text-obsidian text-sm font-bold rounded">
                        {{ $p }}
                    </span>
                @elseif(abs($p - $perfumes->currentPage()) <= 2 || $p == 1 || $p == $perfumes->lastPage())
                    <button
                        @click="filters.page = {{ $p }}; applyFilters()"
                        class="w-8 h-8 flex items-center justify-center text-ink hover:text-gold text-sm transition-colors"
                    >{{ $p }}</button>
                @elseif(abs($p - $perfumes->currentPage()) === 3)
                    <span class="px-1 text-ash">…</span>
                @endif
            @endfor

            {{-- Next --}}
            @if($perfumes->hasMorePages())
                <button
                    @click="filters.page = {{ $perfumes->currentPage() + 1 }}; applyFilters()"
                    class="px-3 py-2 text-ink hover:text-gold text-sm transition-colors"
                >→</button>
            @else
                <span class="px-3 py-2 text-ash text-sm cursor-not-allowed">→</span>
            @endif
        </nav>
    </div>
    @endif
@endif
