<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Resolve a setting value by key with optional default.
     */
    function setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

