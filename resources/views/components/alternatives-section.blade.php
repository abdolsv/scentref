{{-- resources/views/components/alternatives-section.blade.php --}}
@props(['alternatives'])

<section>
    <h2 class="font-display text-2xl font-bold text-ink mb-6">Alternatives & Dupes</h2>

    @php
        $groups = [
            'dupe'         => ['label' => 'Cheaper Dupes', 'icon' => '💰', 'color' => 'green'],
            'budget'       => ['label' => 'Budget Alternatives', 'icon' => '₦', 'color' => 'blue'],
            'similar_smell'=> ['label' => 'Similar Scent Profile', 'icon' => '≈', 'color' => 'purple'],
            'premium'      => ['label' => 'Premium Upgrade', 'icon' => '↑', 'color' => 'gold'],
            'same_house'   => ['label' => 'Same House / Brand', 'icon' => '🏠', 'color' => 'gray'],
        ];
        $grouped = $alternatives->groupBy(fn($a) => $a->pivot->relationship_type);
    @endphp

    <div class="space-y-6">
        @foreach($groups as $type => $meta)
            @if(isset($grouped[$type]) && $grouped[$type]->isNotEmpty())
            <div>
                <h3 class="text-sm font-semibold text-ash uppercase tracking-wide mb-3">
                    {{ $meta['icon'] }} {{ $meta['label'] }}
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($grouped[$type] as $alt)
                    <a href="{{ route('perfumes.show', $alt->slug) }}"
                       class="flex items-center gap-3 bg-white border border-gray-100 rounded-lg p-3 hover:border-gold hover:shadow-sm transition-all group">
                        {{-- Bottle thumb --}}
                        <div class="w-12 h-12 bg-obsidian/5 rounded-lg flex-shrink-0 overflow-hidden">
                            @if($alt->bottle_image_path)
                            <img src="{{ Storage::url($alt->bottle_image_path) }}"
                                 alt="{{ $alt->name }}"
                                 class="w-full h-full object-contain p-1"
                                 loading="lazy">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="font-display text-xs font-bold text-obsidian/30">
                                    {{ strtoupper(substr($alt->name, 0, 2)) }}
                                </span>
                            </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] text-ash truncate">{{ $alt->brand->name }}</p>
                            <p class="text-sm font-semibold text-ink group-hover:text-gold transition-colors truncate">
                                {{ $alt->name }}
                            </p>
                            @if($alt->currentPrices->isNotEmpty())
                            <p class="font-mono text-gold text-xs font-bold">
                                {{ $alt->price_range }}
                            </p>
                            @endif
                        </div>
                    </a>

                    @if($alt->pivot->editorial_note)
                    <p class="text-ash text-xs italic -mt-2 px-1 col-span-full sm:col-span-1">
                        "{{ $alt->pivot->editorial_note }}"
                    </p>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>
