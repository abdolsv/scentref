{{-- resources/views/components/perfume-card.blade.php --}}
{{--
    Props:
      - $perfume  : App\Models\Perfume  (with brand + currentPrices.vendor loaded)
      - $compact  : bool (optional, defaults false — removes description row)
--}}
@props(['perfume', 'compact' => false])

<a href="{{ route('perfumes.show', $perfume->slug) }}"
   class="card flex flex-col group overflow-hidden">

    {{-- Bottle Image --}}
    <div class="relative bg-gradient-to-br from-obsidian/5 to-obsidian/10 aspect-square overflow-hidden">
        @if($perfume->bottle_image_path)
            <img
                src="{{ Storage::url($perfume->bottle_image_path) }}"
                alt="{{ $perfume->name }} by {{ $perfume->brand->name }}"
                class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300"
                loading="lazy"
            >
        @else
            <div class="w-full h-full flex items-center justify-center">
                <span class="font-display text-4xl font-bold text-obsidian/20">
                    {{ strtoupper(substr($perfume->name, 0, 2)) }}
                </span>
            </div>
        @endif

        {{-- Verdict Badge --}}
        @if($perfume->our_verdict === 'must_buy')
            <span class="absolute top-2 left-2 bg-gold text-obsidian text-[10px] font-bold px-2 py-0.5 rounded">
                ★ Must Buy
            </span>
        @elseif($perfume->our_verdict === 'highly_recommended')
            <span class="absolute top-2 left-2 bg-obsidian text-gold text-[10px] font-bold px-2 py-0.5 rounded">
                ✓ Highly Rec.
            </span>
        @endif

        {{-- Gender tag --}}
        <span class="absolute top-2 right-2 bg-white/80 text-ink text-[10px] font-semibold px-2 py-0.5 rounded">
            {{ ucfirst($perfume->gender_target) }}
        </span>
    </div>

    {{-- Info --}}
    <div class="p-3 flex flex-col gap-1 flex-1">
        <p class="text-ash text-[11px] font-mono uppercase tracking-wide truncate">
            {{ $perfume->brand->name }}
        </p>
        <p class="font-semibold text-ink text-sm leading-snug line-clamp-2 group-hover:text-gold transition-colors">
            {{ $perfume->name }}
        </p>
        <p class="text-[11px] text-ash">
            {{ strtoupper($perfume->concentration) }}
        </p>

        @unless($compact)
        {{-- Nigerian Heat Bar --}}
        @if($perfume->longevity_heat)
        <div class="mt-1">
            <div class="flex justify-between text-[10px] text-ash mb-0.5">
                <span>Lagos Heat</span>
                <span class="font-mono text-gold">{{ $perfume->longevity_heat }}/10</span>
            </div>
            <div class="rating-bar">
                <div class="rating-bar-fill" style="width:{{ $perfume->longevity_heat * 10 }}%"></div>
            </div>
        </div>
        @endif
        @endunless

        {{-- Price --}}
        <div class="mt-auto pt-2 border-t border-gray-100 flex items-center justify-between">
            <span class="font-mono font-bold text-gold text-sm">
                {{ $perfume->price_range ?? 'Price N/A' }}
            </span>
            @if($perfume->pw_rating)
            <span class="text-[11px] font-mono text-ash">
                ★ {{ $perfume->pw_rating }}/10
            </span>
            @endif
        </div>
    </div>
</a>
