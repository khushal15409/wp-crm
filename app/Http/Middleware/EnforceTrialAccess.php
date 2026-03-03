<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceTrialAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return $next($request);
        }

        if (! method_exists($user, 'isOrganization') || ! $user->isOrganization()) {
            return $next($request);
        }

        $organization = $user->organization;

        if (! $organization) {
            return $next($request);
        }

        // If org has an active paid subscription, allow everything
        if ($organization->hasActivePaidSubscription()) {
            return $next($request);
        }

        // If org is in trial and still within trial window, allow everything
        if ($organization->isTrial() && ! $organization->isTrialExpired()) {
            return $next($request);
        }

        // Trial expired and no active subscription: allow read-only (GET, HEAD, OPTIONS)
        if (! $request->isMethodSafe()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Your free trial has ended. Please upgrade to continue using WP-CRM.',
                ], 403);
            }

            return redirect()
                ->route('dashboard')
                ->with('error', 'Your free trial has ended. Please upgrade to continue using WP-CRM.');
        }

        return $next($request);
    }
}

