<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\RazorpayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SubscriptionPaymentController extends Controller
{
    public function __construct(
        protected RazorpayService $razorpay
    ) {}

    /**
     * Create Razorpay order for a plan. Amount is always fetched from DB (never trust frontend).
     */
    public function checkout(Plan $plan): JsonResponse
    {
        $this->authorizeOrganization();

        if (! $plan->is_active) {
            throw ValidationException::withMessages(['plan' => ['This plan is not available.']]);
        }

        if (! $this->razorpay->isConfigured()) {
            return response()->json(['message' => 'Payment gateway is not configured.'], 503);
        }

        $amountInr = $plan->getPriceMonthlyInr();
        if ($amountInr < 1) {
            throw ValidationException::withMessages(['plan' => ['Invalid plan price.']]);
        }

        $organization = auth()->user()->organization;
        $receipt = 'sub_' . $organization->id . '_' . $plan->id . '_' . time();

        try {
            $order = $this->razorpay->createOrder($amountInr, $receipt, [
                'organization_id' => (string) $organization->id,
                'plan_id' => (string) $plan->id,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Could not create order.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 502);
        }

        return response()->json([
            'order_id' => $order['id'],
            'key_id' => $this->razorpay->getKeyId(),
            'amount' => $order['amount'],
            'currency' => $order['currency'],
        ]);
    }

    /**
     * Verify Razorpay payment and activate subscription.
     */
    public function verify(Request $request): JsonResponse
    {
        $this->authorizeOrganization();

        $validated = $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'plan_id' => 'required|integer|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);
        if (! $plan->is_active) {
            throw ValidationException::withMessages(['plan' => ['This plan is not available.']]);
        }

        $amountInr = $plan->getPriceMonthlyInr();
        if ($amountInr < 1) {
            throw ValidationException::withMessages(['plan' => ['Invalid plan price.']]);
        }

        try {
            $this->razorpay->verifyPaymentSignature(
                $validated['razorpay_order_id'],
                $validated['razorpay_payment_id'],
                $validated['razorpay_signature']
            );
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Payment verification failed.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 400);
        }

        $organization = auth()->user()->organization;

        try {
            DB::transaction(function () use ($organization, $plan, $amountInr, $validated) {
                $startsAt = now();
                $endsAt = now()->addMonth();

                Subscription::create([
                    'organization_id' => $organization->id,
                    'plan_id' => $plan->id,
                    'price_at_purchase' => $amountInr,
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                    'trial_ends_at' => null,
                    'status' => 'active',
                ]);

                Payment::create([
                    'organization_id' => $organization->id,
                    'plan_id' => $plan->id,
                    'razorpay_payment_id' => $validated['razorpay_payment_id'],
                    'razorpay_order_id' => $validated['razorpay_order_id'],
                    'amount' => $amountInr,
                    'status' => 'captured',
                    'response' => [
                        'verified_at' => now()->toIso8601String(),
                    ],
                ]);
            });
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Could not activate subscription.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }

        return response()->json([
            'message' => 'Payment successful. Subscription activated.',
            'redirect' => route('subscriptions.index'),
        ]);
    }

    protected function authorizeOrganization(): void
    {
        $user = auth()->user();
        if (! $user || ! $user->organization_id) {
            throw ValidationException::withMessages(['user' => ['You must belong to an organization to subscribe.']]);
        }
    }
}
