<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Price extends Model
{
    protected $fillable = [
        'perfume_id',
        'vendor_id',
        'price_ngn',
        'is_verified',
        'verified_by',
        'source_url',
        'is_current',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_current' => 'boolean',
        'price_ngn' => 'decimal:2',
    ];

    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Modern Laravel Attribute Cast for Affiliate URL resolution
     */
    protected function affiliateUrl(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (!$this->source_url) {
                    return '#';
                }

                return match ($this->vendor?->slug) {
                    'jumia' => $this->source_url . '?aff_id=' . config('scentref.jumia_aff_id'),
                    'konga' => $this->source_url . '?ref=' . config('scentref.konga_ref'),
                    default => $this->source_url,
                };
            }
        );
    }
}
