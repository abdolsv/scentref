@props(["prices"])
<section class="bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
        <h2 class="font-display text-lg font-bold text-ink">Where to Buy in Nigeria</h2>
    </div>
    @if($prices->isEmpty())
        <p class="p-5 text-ash text-sm">No price data available yet.</p>
    @else
    <table class="w-full">
        <thead class="text-xs text-ash uppercase tracking-wide">
            <tr>
                <th class="text-left px-5 py-3">Vendor</th>
                <th class="text-right px-5 py-3">Price</th>
                <th class="text-right px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($prices->sortBy("price_ngn") as $price)
            <tr class="hover:bg-ivory transition-colors">
                <td class="px-5 py-4">
                    <span class="font-semibold text-ink text-sm">{{ $price->vendor->name }}</span>
                    @if($price->is_verified)<span class="ml-2 text-green-600 text-xs">✓ Verified</span>@endif
                </td>
                <td class="px-5 py-4 text-right font-mono text-gold font-bold">
                    ₦{{ number_format($price->price_ngn) }}
                </td>
                <td class="px-5 py-4 text-right">
                    @if($price->source_url)
                    <a href="{{ $price->affiliate_url }}" target="_blank" rel="nofollow sponsored"
                       class="bg-gold text-obsidian px-3 py-1.5 rounded text-xs font-bold hover:bg-gold-dark transition-colors">
                        Buy on {{ $price->vendor->name }}
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="px-5 py-3 text-ash text-xs border-t border-gray-50">
        Last updated: {{ $prices->first()?->updated_at?->diffForHumans() ?? "Unknown" }}
    </p>
    @endif
</section>
