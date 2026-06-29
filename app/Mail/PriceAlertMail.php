<?php
// app/Mail/PriceAlertMail.php
namespace App\Mail;

use App\Models\{PriceAlert, Price};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Address, Content, Envelope};
use Illuminate\Queue\SerializesModels;

class PriceAlertMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly PriceAlert $alert,
        public readonly Price      $triggeredPrice,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from:    new Address('alerts@scentref.ng', 'ScentRef Price Alerts'),
            subject: '🔔 Price Drop: ' . $this->alert->perfume->name
                     . ' is now ₦' . number_format($this->triggeredPrice->price_ngn),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.price-alert',
            with: [
                'alert'          => $this->alert,
                'triggeredPrice' => $this->triggeredPrice,
                'perfume'        => $this->alert->perfume->load('brand'),
                'vendor'         => $this->triggeredPrice->vendor,
                'unsubscribeUrl' => route('price-alerts.unsubscribe', [
                    'token' => $this->alert->unsubscribe_token,
                ]),
                'perfumeUrl'     => route('perfumes.show', $this->alert->perfume->slug),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
