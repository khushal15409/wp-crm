<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppSetting extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_settings';

    protected $fillable = [
        'provider',
        'app_id',
        'app_secret',
        'phone_number_id',
        'business_account_id',
        'access_token',
        'webhook_verify_token',
        'status',
    ];

    /**
     * Never expose these in JSON/array serialization.
     */
    protected $hidden = [
        'app_secret',
        'access_token',
    ];

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Get the single active configuration (system-wide).
     */
    public static function getActive(): ?self
    {
        return static::where('status', 'active')->first();
    }
}
