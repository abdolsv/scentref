<?php

namespace App\Jobs;

use App\Mail\ReviewVerificationMail;
use App\Models\Review;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendReviewVerificationEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Review $review
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->review->reviewer_email)
            ->send(new ReviewVerificationMail($this->review));
    }
}
