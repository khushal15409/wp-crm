<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\WhatsAppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'settings' => 'array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
            'settings.*.group' => 'required|string',
        ]);
        $keepIfEmpty = ['whatsapp_access_token', 'whatsapp_verify_token', 'razorpay_key_secret', 'razorpay_webhook_secret'];
        foreach ($request->input('settings', []) as $s) {
            $value = $s['value'] ?? '';
            if (in_array($s['key'], $keepIfEmpty, true) && (string) $value === '') {
                continue; // leave existing value unchanged
            }
            Setting::set($s['key'], $value, $s['group']);
        }
        return redirect()->route('settings.index')->with('success', 'Settings saved.');
    }

    public function testWhatsApp(WhatsAppService $whatsApp): RedirectResponse
    {
        $result = $whatsApp->testConnection();
        return redirect()
            ->route('settings.index')
            ->with($result['ok'] ? 'success' : 'error', $result['message']);
    }
}
