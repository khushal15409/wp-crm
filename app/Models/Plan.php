<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'price_monthly',
        'interval',
        'lead_limit',
        'broadcast_limit',
        'features',
        'is_active',
        'is_popular',
        'trial_days',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'price' => 'decimal:2',
        'features' => 'array',
    ];

    /**
     * Monthly price in INR (integer). Prefer price_monthly; fallback to (int) price.
     */
    public function getPriceMonthlyInr(): int
    {
        return (int) ($this->price_monthly ?? round($this->price ?? 0));
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
