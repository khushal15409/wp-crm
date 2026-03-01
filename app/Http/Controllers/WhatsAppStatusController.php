<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppSetting;
use Illuminate\View\View;

class WhatsAppStatusController extends Controller
{
    /**
     * Organization read-only: connection status, phone number, webhook status, last sync.
     * No credentials, no input fields, no save buttons.
     */
    public function index(): View
    {
        $setting = WhatsAppSetting::getActive();
        return view('whatsapp-status.index', compact('setting'));
    }
}
