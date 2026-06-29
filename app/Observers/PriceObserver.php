<?php

namespace App\Observers;

use App\Jobs\{RecalculateAveragePrice, SendPriceAlertNotification};
use App\Models\Price;

class PriceObserver
{
    public function creating(Price $price): void
    {
        Price::where("perfume_id", $price->perfume_id)
             ->where("vendor_id", $price->vendor_id)
             ->update(["is_current" => false]);
    }

    public function created(Price $price): void
    {
        RecalculateAveragePrice::dispatch($price->perfume_id)->onQueue("default");
        SendPriceAlertNotification::dispatch($price)->onQueue("notifications");
    }
}

