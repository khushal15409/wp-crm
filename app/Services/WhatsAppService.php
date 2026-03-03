<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Organization;
use App\Models\WhatsAppMessage;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function __construct(
        protected HttpFactory $http
    ) {
    }

    public function baseUrl(): ?string
    {
        return setting('whatsapp_base_url');
    }

    public function accessToken(): ?string
    {
        return setting('whatsapp_access_token');
    }

    public function verifyToken(): ?string
    {
        return setting('whatsapp_verify_token');
    }

    public function phoneNumberId(): ?string
    {
        return setting('whatsapp_phone_number_id');
    }

    public function businessAccountId(): ?string
    {
        return setting('whatsapp_business_account_id');
    }

    public function defaultOrganization(): ?Organization
    {
        $orgId = setting('whatsapp_default_organization_id');
        if ($orgId) {
            return Organization::find($orgId);
        }

        return Organization::where('is_active', true)->orderBy('id')->first();
    }

    public function testConnection(): array
    {
        $phoneId = $this->phoneNumberId();
        $token = $this->accessToken();
        $baseUrl = rtrim((string) $this->baseUrl(), '/');

        if (! $phoneId || ! $token || ! $baseUrl) {
            return [
                'ok' => false,
                'message' => 'Base URL, Phone Number ID, and Access Token are required.',
            ];
        }

        try {
            $url = "{$baseUrl}/{$phoneId}";
            /** @var Response $response */
            $response = $this->http->withToken($token)->get($url);
            if ($response->successful()) {
                return ['ok' => true, 'message' => 'Connection test successful.'];
            }

            $error = $response->json('error.message') ?? $response->body() ?? 'Connection failed.';
            Log::warning('WhatsApp testConnection failed', ['url' => $url, 'error' => $error]);
            return ['ok' => false, 'message' => 'Connection test failed: '.$error];
        } catch (\Throwable $e) {
            Log::error('WhatsApp testConnection exception', ['exception' => $e]);
            return ['ok' => false, 'message' => 'Connection test failed: '.$e->getMessage()];
        }
    }

    /**
    * Basic webhook payload handler: find/create lead and log message.
    */
    public function handleIncoming(array $payload): void
    {
        try {
            foreach (($payload['entry'] ?? []) as $entry) {
                foreach (($entry['changes'] ?? []) as $change) {
                    $value = $change['value'] ?? [];
                    $metadata = $value['metadata'] ?? [];
                    $messages = $value['messages'] ?? [];

                    $phoneNumberId = $metadata['phone_number_id'] ?? null;
                    if (! $phoneNumberId || empty($messages)) {
                        continue;
                    }

                    $organization = $this->defaultOrganization();
                    if (! $organization) {
                        Log::warning('WhatsApp incoming: no organization resolved', ['phone_number_id' => $phoneNumberId]);
                        continue;
                    }

                    foreach ($messages as $message) {
                        $from = $message['from'] ?? null;
                        $messageId = $message['id'] ?? null;
                        $body = $message['text']['body'] ?? ($message['button']['text'] ?? null);

                        if (! $from || ! $messageId) {
                            continue;
                        }

                        $lead = Lead::where('organization_id', $organization->id)
                            ->where('phone', $from)
                            ->first();

                        if (! $lead) {
                            $lead = Lead::create([
                                'organization_id' => $organization->id,
                                'whatsapp_id' => $messageId,
                                'phone' => $from,
                                'name' => null,
                                'email' => null,
                                'source' => 'whatsapp',
                                'stage' => 'new',
                                'notes' => null,
                            ]);
                        }

                        // Avoid duplicate message records
                        if ($messageModel = WhatsAppMessage::where('whatsapp_id', $messageId)->first()) {
                            continue;
                        }

                        WhatsAppMessage::create([
                            'organization_id' => $organization->id,
                            'lead_id' => $lead->id,
                            'whatsapp_id' => $messageId,
                            'from' => $from,
                            'to' => $metadata['display_phone_number'] ?? null,
                            'direction' => 'inbound',
                            'body' => $body,
                            'payload' => $message,
                        ]);
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::error('WhatsApp incoming handler failed', ['exception' => $e]);
        }
    }
}

