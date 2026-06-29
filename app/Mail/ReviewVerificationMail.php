<?php
// app/Mail/ReviewVerificationMail.php
namespace App\Mail;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Address, Content, Envelope};
use Illuminate\Queue\SerializesModels;

class ReviewVerificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Review $review,
        public readonly string $verificationUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from:    new Address('reviews@scentref.ng', 'ScentRef Reviews'),
            subject: 'Verify your review for ' . $this->review->perfume->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.review-verification',
            with: [
                'review'          => $this->review,
                'verificationUrl' => $this->verificationUrl,
                'perfumeName'     => $this->review->perfume->name,
                'brandName'       => $this->review->perfume->brand->name,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
