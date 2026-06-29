<?php

namespace App\Jobs;

use App\Mail\PriceAlertMail;
use App\Models\Price;
use App\Models\PriceAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendPriceAlertNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Price $price
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $alerts = PriceAlert::where('perfume_id', $this->price->perfume_id)
            ->where('is_active', true)
            ->where('target_price_ngn', '>=', $this->price->price_ngn)
            ->get();

        foreach ($alerts as $alert) {
            Mail::to($alert->email)
                ->send(new PriceAlertMail($alert, $this->price));

            $alert->update([
                'last_notified_at' => now(),
            ]);
        }
    }
}
