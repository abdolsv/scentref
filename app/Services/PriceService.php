<?php

namespace App\Services;

use App\Models\{Perfume, Price, Vendor};
use Illuminate\Support\Facades\DB;

class PriceService
{
    public function addPrice(int $perfumeId, int $vendorId, float $priceNgn, ?string $sourceUrl = null): Price
    {
        return DB::transaction(function () use ($perfumeId, $vendorId, $priceNgn, $sourceUrl) {
            // Observer handles marking old prices as not current
            return Price::create([
                "perfume_id" => $perfumeId,
                "vendor_id"  => $vendorId,
                "price_ngn"  => $priceNgn,
                "source_url" => $sourceUrl,
                "is_current" => true,
            ]);
        });
    }

    public function recalculateAverage(int $perfumeId): void
    {
        $avg = Price::where("perfume_id", $perfumeId)
                    ->where("is_current", true)
                    ->avg("price_ngn");
        Perfume::where("id", $perfumeId)->update([
            "avg_price_ngn"      => $avg,
            "last_price_updated" => now()->toDateString(),
        ]);
    }

    public function getPriceHistory(int $perfumeId, int $vendorId, int $days = 180): array
    {
        return Price::where("perfume_id", $perfumeId)
                    ->where("vendor_id", $vendorId)
                    ->where("created_at", ">=", now()->subDays($days))
                    ->orderBy("created_at")
                    ->get()
                    ->map(fn($p) => [
                        "date"  => $p->created_at->format("Y-m-d"),
                        "price" => (float)$p->price_ngn,
                    ])->toArray();
    }
}

