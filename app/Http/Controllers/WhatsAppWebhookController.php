<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WhatsAppWebhookController extends Controller
{
    public function __construct(
        protected WhatsAppService $whatsApp
    ) {
    }

    /**
     * Verify Meta webhook using verify token stored in settings.
     */
    public function verify(Request $request): Response
    {
        $mode = $request->query('hub_mode');
        $token = $request->query('hub_verify_token');
        $challenge = $request->query('hub_challenge');

        if ($mode === 'subscribe' && $token && $token === $this->whatsApp->verifyToken()) {
            return response($challenge, 200);
        }

        return response('Forbidden', 403);
    }

    /**
     * Handle incoming webhook events from WhatsApp Cloud API.
     */
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->all();
        Log::info('WhatsApp webhook received', ['payload' => $payload]);

        $this->whatsApp->handleIncoming($payload);

        return response()->json(['status' => 'ok']);
    }
}

