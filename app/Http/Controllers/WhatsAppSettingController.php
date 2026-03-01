<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class WhatsAppSettingController extends Controller
{
    public function index(): View
    {
        $settings = WhatsAppSetting::latest()->get();
        return view('whatsapp-settings.index', compact('settings'));
    }

    public function create(): View
    {
        return view('whatsapp-settings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'provider' => 'required|string|in:meta',
            'app_id' => 'required|string|max:255',
            'app_secret' => 'required|string',
            'phone_number_id' => 'required|string|max:255',
            'business_account_id' => 'nullable|string|max:255',
            'access_token' => 'required|string',
            'webhook_verify_token' => 'nullable|string|max:255',
            'status' => 'string|in:active,inactive',
        ]);
        $data['status'] = $data['status'] ?? 'inactive';

        if (($data['status'] ?? '') === 'active') {
            WhatsAppSetting::where('id', '>', 0)->update(['status' => 'inactive']);
        }
        WhatsAppSetting::create($data);
        return redirect()->route('whatsapp-settings.index')->with('success', 'WhatsApp API configuration saved.');
    }

    public function show(WhatsAppSetting $whatsappSetting): View
    {
        return view('whatsapp-settings.show', compact('whatsappSetting'));
    }

    public function edit(WhatsAppSetting $whatsappSetting): View
    {
        return view('whatsapp-settings.edit', compact('whatsappSetting'));
    }

    public function update(Request $request, WhatsAppSetting $whatsappSetting): RedirectResponse
    {
        $data = $request->validate([
            'provider' => 'required|string|in:meta',
            'app_id' => 'required|string|max:255',
            'app_secret' => 'nullable|string', // allow empty to keep existing
            'phone_number_id' => 'required|string|max:255',
            'business_account_id' => 'nullable|string|max:255',
            'access_token' => 'nullable|string', // allow empty to keep existing
            'webhook_verify_token' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($data['status'] === 'active') {
            WhatsAppSetting::where('id', '!=', $whatsappSetting->id)->update(['status' => 'inactive']);
        }
        if (($data['app_secret'] ?? '') === '') {
            unset($data['app_secret']);
        }
        if (($data['access_token'] ?? '') === '') {
            unset($data['access_token']);
        }
        $whatsappSetting->update($data);
        return redirect()->route('whatsapp-settings.index')->with('success', 'WhatsApp configuration updated.');
    }

    public function destroy(WhatsAppSetting $whatsappSetting): RedirectResponse
    {
        $whatsappSetting->delete();
        return redirect()->route('whatsapp-settings.index')->with('success', 'Configuration removed.');
    }

    /**
     * Test connection using Meta Graph API (no credentials sent to frontend).
     */
    public function testConnection(WhatsAppSetting $whatsappSetting): RedirectResponse
    {
        $token = $whatsappSetting->getRawOriginal('access_token');
        $phoneId = $whatsappSetting->phone_number_id;
        if (! $token || ! $phoneId) {
            return redirect()->back()->with('error', 'Access token and Phone Number ID are required to test.');
        }
        $url = "https://graph.facebook.com/v18.0/{$phoneId}";
        $response = Http::withToken($token)->get($url);
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Connection test successful.');
        }
        $message = $response->json('error.message') ?? $response->body() ?? 'Connection failed.';
        return redirect()->back()->with('error', 'Connection test failed: ' . $message);
    }
}
