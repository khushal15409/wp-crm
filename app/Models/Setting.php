<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, $default = null)
    {
        $cacheKey = 'setting_' . $key;
        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $s = static::where('key', $key)->first();
            if (! $s) {
                return $default;
            }

            $value = $s->value;

            if (in_array($key, static::encryptedKeys(), true) && $value !== null && $value !== '') {
                try {
                    return Crypt::decryptString($value);
                } catch (\Throwable $e) {
                    // Fallback for legacy plain-text values.
                    return $value;
                }
            }

            return $value;
        });
    }

    public static function set(string $key, $value, string $group = 'general'): void
    {
        $storeValue = $value;

        if (in_array($key, static::encryptedKeys(), true) && $value !== null && $value !== '') {
            $storeValue = Crypt::encryptString($value);
        }

        static::updateOrCreate(
            ['key' => $key],
            ['value' => $storeValue, 'group' => $group]
        );
        Cache::forget('setting_' . $key);
    }

    /**
     * Keys that should be stored encrypted at rest.
     */
    protected static function encryptedKeys(): array
    {
        return [
            'whatsapp_access_token',
            'whatsapp_verify_token',
            'whatsapp_app_secret',
            'razorpay_key_secret',
            'razorpay_webhook_secret',
        ];
    }
}
