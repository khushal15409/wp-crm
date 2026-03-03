<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Services\RazorpayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RazorpayWebhookController extends Controller
{
    public function __construct(
        protected RazorpayService $razorpay
    ) {}

    /**
     * Handle Razorpay webhook. Verify signature then process payment.captured / payment.failed.
     */
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature', '');

        if (empty($signature)) {
            Log::warning('Razorpay webhook: missing signature');
            return response()->json(['message' => 'Missing signature'], 400);
        }

        try {
            $this->razorpay->verifyWebhookSignature($payload, $signature);
        } catch (\Throwable $e) {
            Log::warning('Razorpay webhook: signature verification failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        $data = json_decode($payload, true);
        $event = $data['event'] ?? null;

        if (! $event) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        try {
            if ($event === 'payment.captured') {
                $this->handlePaymentCaptured($data);
            } elseif ($event === 'payment.failed') {
                $this->handlePaymentFailed($data);
            }
        } catch (\Throwable $e) {
            Log::error('Razorpay webhook processing error', ['event' => $event, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Processing error'], 500);
        }

        return response()->json(['message' => 'OK']);
    }

    protected function handlePaymentCaptured(array $data): void
    {
        $paymentPayload = $data['payload']['payment']['entity'] ?? null;
        if (! $paymentPayload) {
            return;
        }

        $razorpayPaymentId = $paymentPayload['id'] ?? null;
        $razorpayOrderId = $paymentPayload['order_id'] ?? null;
        $amountPaise = (int) ($paymentPayload['amount'] ?? 0);
        $amountInr = (int) round($amountPaise / 100);

        $notes = $paymentPayload['notes'] ?? [];
        $organizationId = isset($notes['organization_id']) ? (int) $notes['organization_id'] : null;
        $planId = isset($notes['plan_id']) ? (int) $notes['plan_id'] : null;

        if (! $organizationId || ! $planId) {
            Log::info('Razorpay webhook payment.captured: missing notes', ['payment_id' => $razorpayPaymentId]);
            return;
        }

        $existing = Payment::where('razorpay_payment_id', $razorpayPaymentId)->first();
        if ($existing) {
            $existing->update(['status' => 'captured', 'response' => $paymentPayload]);
            return;
        }

        DB::transaction(function () use ($organizationId, $planId, $razorpayPaymentId, $razorpayOrderId, $amountInr, $paymentPayload) {
            Payment::create([
                'organization_id' => $organizationId,
                'plan_id' => $planId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_order_id' => $razorpayOrderId,
                'amount' => $amountInr,
                'status' => 'captured',
                'response' => $paymentPayload,
            ]);

            Subscription::create([
                'organization_id' => $organizationId,
                'plan_id' => $planId,
                'price_at_purchase' => $amountInr,
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'trial_ends_at' => null,
                'status' => 'active',
            ]);
        });
    }

    protected function handlePaymentFailed(array $data): void
    {
        $paymentPayload = $data['payload']['payment']['entity'] ?? null;
        if (! $paymentPayload) {
            return;
        }

        $razorpayPaymentId = $paymentPayload['id'] ?? null;
        $notes = $paymentPayload['notes'] ?? [];
        $organizationId = isset($notes['organization_id']) ? (int) $notes['organization_id'] : null;
        $planId = isset($notes['plan_id']) ? (int) $notes['plan_id'] : null;
        $amountPaise = (int) ($paymentPayload['amount'] ?? 0);
        $amountInr = (int) round($amountPaise / 100);

        if ($organizationId && $planId) {
            Payment::updateOrCreate(
                ['razorpay_payment_id' => $razorpayPaymentId],
                [
                    'organization_id' => $organizationId,
                    'plan_id' => $planId,
                    'razorpay_order_id' => $paymentPayload['order_id'] ?? null,
                    'amount' => $amountInr,
                    'status' => 'failed',
                    'response' => $paymentPayload,
                ]
            );
        }

        Log::info('Razorpay payment failed', ['payment_id' => $razorpayPaymentId]);
    }
}
