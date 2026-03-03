<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;
use Illuminate\View\View;

class WhatsAppStatusController extends Controller
{
    /**
     * Organization read-only: connection status from System Settings.
     * No credentials, no input fields, no save buttons.
     */
    public function index(WhatsAppService $whatsApp): View
    {
        $configured = (bool) $whatsApp->phoneNumberId() && (bool) $whatsApp->accessToken() && (bool) $whatsApp->baseUrl();
        $result = $configured ? $whatsApp->testConnection() : ['ok' => false, 'message' => 'Not configured'];
        return view('whatsapp-status.index', [
            'configured' => $configured,
            'connected' => $result['ok'],
            'phone_number_id' => $whatsApp->phoneNumberId(),
        ]);
    }
}
