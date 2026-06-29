@props(["perfume"])
<section class="bg-white rounded-xl border border-gray-100 p-6">
    <h2 class="font-display text-2xl font-bold text-ink mb-6">Frequently Asked Questions</h2>
    <div class="space-y-4">
        @php 
            // Robustly extract cities, handling cases where it might be a JSON string or array
            $citiesRaw = $perfume->physical_store_cities;
            $citiesArray = is_array($citiesRaw) ? $citiesRaw : json_decode($citiesRaw, true);
            $cities = (!empty($citiesArray) && is_array($citiesArray)) 
                ? implode(", ", $citiesArray) 
                : "Jumia and Konga online"; 
        @endphp

        <details class="border-b pb-4">
            <summary class="font-semibold text-ink cursor-pointer hover:text-gold">
                Is {{ $perfume->name }} available in Nigeria?
            </summary>
            <p class="mt-2 text-ash text-sm">
                @switch($perfume->availability)
                    @case("available") {{ $perfume->name }} is available in Nigeria at {{ $cities }}. @break
                    @case("import_only") {{ $perfume->name }} is available in Nigeria via import or specialist vendors. @break
                    @default {{ $perfume->name }} is not currently available in Nigeria. @break
                @endswitch
            </p>
        </details>

        @if($perfume->longevity_heat)
        <details class="border-b pb-4">
            <summary class="font-semibold text-ink cursor-pointer hover:text-gold">
                How long does {{ $perfume->name }} last in Nigerian heat?
            </summary>
            <p class="mt-2 text-ash text-sm">
                {{ $perfume->name }} has a Nigerian outdoor heat longevity rating of {{ $perfume->longevity_heat }}/10,
                lasting approximately {{ $perfume->longevity_hours_avg }} hours outdoors.
            </p>
        </details>
        @endif

        @if($perfume->currentPrices->isNotEmpty())
        <details class="pb-4">
            <summary class="font-semibold text-ink cursor-pointer hover:text-gold">
                What is the price of {{ $perfume->name }} in Nigeria?
            </summary>
            <p class="mt-2 text-ash text-sm">
                As of {{ $perfume->last_price_updated?->format("F Y") ?? "current date" }},
                {{ $perfume->name }} is priced at {{ $perfume->price_range }} in Nigeria.
            </p>
        </details>
        @endif
    </div>
</section>
