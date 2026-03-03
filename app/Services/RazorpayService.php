<?php

namespace App\Services;

use Razorpay\Api\Api;
use RuntimeException;

class RazorpayService
{
    protected ?Api $api = null;

    /**
     * Get Razorpay key_id from settings (for frontend).
     */
    public function getKeyId(): string
    {
        $key = setting('razorpay_key_id');
        if (empty($key)) {
            throw new RuntimeException('Razorpay Key ID is not configured. Set it in Super Admin → Settings → Razorpay.');
        }
        return $key;
    }

    /**
     * Initialize and return Razorpay API client using settings.
     */
    public function getApi(): Api
    {
        if ($this->api !== null) {
            return $this->api;
        }

        $keyId = setting('razorpay_key_id');
        $keySecret = setting('razorpay_key_secret');

        if (empty($keyId) || empty($keySecret)) {
            throw new RuntimeException('Razorpay credentials are not configured. Set Key ID and Key Secret in Super Admin → Settings → Razorpay.');
        }

        $this->api = new Api($keyId, $keySecret);

        return $this->api;
    }

    /**
     * Create a Razorpay order. Amount must be in paise (INR × 100).
     * Price is always taken from the plan (passed as integer INR); we convert to paise.
     */
    public function createOrder(int $amountInr, string $receipt, array $notes = []): array
    {
        $amountPaise = $amountInr * 100;
        if ($amountPaise < 100) {
            throw new RuntimeException('Order amount must be at least ₹1.');
        }

        $api = $this->getApi();
        $order = $api->order->create([
            'receipt' => $receipt,
            'amount' => $amountPaise,
            'currency' => 'INR',
            'notes' => $notes,
        ]);

        return [
            'id' => $order->id,
            'amount' => $amountPaise,
            'currency' => 'INR',
        ];
    }

    /**
     * Verify payment signature after successful checkout.
     */
    public function verifyPaymentSignature(string $orderId, string $paymentId, string $signature): void
    {
        $api = $this->getApi();
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature,
        ]);
    }

    /**
     * Verify webhook signature. Payload is raw request body; signature from X-Razorpay-Signature header.
     */
    public function verifyWebhookSignature(string $payload, string $signature): void
    {
        $secret = setting('razorpay_webhook_secret');
        if (empty($secret)) {
            throw new RuntimeException('Razorpay webhook secret is not configured.');
        }

        $api = $this->getApi();
        $api->utility->verifyWebhookSignature($payload, $signature, $secret);
    }

    /**
     * Check if Razorpay is configured (key_id and key_secret present).
     */
    public function isConfigured(): bool
    {
        return ! empty(setting('razorpay_key_id')) && ! empty(setting('razorpay_key_secret'));
    }
}
