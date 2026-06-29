<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceAlert extends Model
{
    protected $fillable = [
        'perfume_id',
        'email',
        'target_price_ngn',
        'unsubscribe_token',
        'last_notified_at',
        'is_active',
    ];

    protected $casts = [
        'last_notified_at' => 'datetime',
        'is_active' => 'boolean',
        'target_price_ngn' => 'decimal:2',
    ];

    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }
}
