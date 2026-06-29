<?php

namespace App\Jobs;

use App\Services\PriceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RecalculateAveragePrice implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $perfumeId
    ) {}

    /**
     * Execute the job.
     */
    public function handle(PriceService $priceService): void
    {
        $priceService->recalculateAverage($this->perfumeId);
    }
}
