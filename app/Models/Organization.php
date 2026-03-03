<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'address',
        'business_type',
        'city',
        'is_active',
        'trial_lead_limit',
        'is_trial',
        'trial_ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'trial_ends_at' => 'datetime',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(FollowUp::class);
    }

    public function broadcasts(): HasMany
    {
        return $this->hasMany(Broadcast::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function whatsappAccounts(): HasMany
    {
        return $this->hasMany(WhatsappAccount::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    public function isTrial(): bool
    {
        return (bool) $this->is_trial;
    }

    public function trialLeadLimit(): ?int
    {
        return $this->trial_lead_limit;
    }

    public function hasReachedTrialLeadLimit(): bool
    {
        if (! $this->isTrial() || ! $this->trialLeadLimit()) {
            return false;
        }

        return $this->leads()->count() >= $this->trialLeadLimit();
    }

    public function isTrialExpired(): bool
    {
        if (! $this->isTrial() || ! $this->trial_ends_at) {
            return false;
        }

        return now()->greaterThanOrEqualTo($this->trial_ends_at);
    }

    public function hasActivePaidSubscription(): bool
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('ends_at', '>=', now())
            ->exists();
    }
}
