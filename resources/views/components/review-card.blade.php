{{-- resources/views/components/review-card.blade.php --}}
@props(['review'])

<article class="bg-white rounded-xl border border-gray-100 p-5 mb-4">
    <div class="flex items-start justify-between gap-4 mb-3">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="font-semibold text-ink text-sm">{{ e($review->reviewer_name) }}</span>
                @if($review->reviewer_city)
                <span class="text-ash text-xs">· {{ e($review->reviewer_city) }}</span>
                @endif
                @if($review->verified_purchase)
                <span class="text-green-600 text-xs font-semibold bg-green-50 px-2 py-0.5 rounded">✓ Verified Purchase</span>
                @endif
            </div>
            @if($review->reviewer_climate)
            <p class="text-ash text-xs mt-0.5">
                Context:
                @switch($review->reviewer_climate)
                    @case('hot_outdoor') Tested outdoors (Lagos heat) @break
                    @case('ac_office')   Tested in AC office @break
                    @case('cool_evening') Tested on cool evening @break
                    @case('harmattan')   Tested in harmattan season @break
                @endswitch
            </p>
            @endif
        </div>

        {{-- Overall Rating --}}
        <div class="text-right flex-shrink-0">
            <span class="font-mono font-bold text-2xl text-gold">{{ $review->rating_overall }}</span>
            <span class="text-ash text-xs">/10</span>
        </div>
    </div>

    {{-- Sub-ratings --}}
    @if($review->rating_longevity || $review->rating_sillage || $review->rating_value)
    <div class="flex gap-4 mb-3">
        @if($review->rating_longevity)
        <div class="text-center">
            <p class="text-[10px] text-ash uppercase tracking-wide">Longevity</p>
            <p class="font-mono text-sm font-bold text-ink">{{ $review->rating_longevity }}/10</p>
        </div>
        @endif
        @if($review->rating_sillage)
        <div class="text-center">
            <p class="text-[10px] text-ash uppercase tracking-wide">Sillage</p>
            <p class="font-mono text-sm font-bold text-ink">{{ $review->rating_sillage }}/10</p>
        </div>
        @endif
        @if($review->rating_value)
        <div class="text-center">
            <p class="text-[10px] text-ash uppercase tracking-wide">Value</p>
            <p class="font-mono text-sm font-bold text-ink">{{ $review->rating_value }}/10</p>
        </div>
        @endif
    </div>
    @endif

    {{-- Title --}}
    @if($review->review_title)
    <p class="font-semibold text-ink text-sm mb-2">{{ e($review->review_title) }}</p>
    @endif

    {{-- Body --}}
    <p class="text-ink text-sm leading-relaxed">{{ e($review->review_body) }}</p>

    {{-- Purchase info + date --}}
    <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50">
        @if($review->purchase_source)
        <span class="text-ash text-xs">Bought from: {{ e($review->purchase_source) }}
            @if($review->purchase_price_ngn)
            · ₦{{ number_format($review->purchase_price_ngn) }}
            @endif
        </span>
        @else
        <span></span>
        @endif
        <span class="text-ash text-xs">{{ $review->created_at->format('M j, Y') }}</span>
    </div>
</article>
