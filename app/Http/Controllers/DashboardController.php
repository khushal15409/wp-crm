<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Lead;
use App\Models\Organization;
use App\Models\Subscription;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->hasRole('super_admin')) {
            $stats = [
                'organizations' => Organization::count(),
                'leads' => Lead::count(),
                'subscriptions' => Subscription::where('status', 'active')->count(),
                'broadcasts' => Broadcast::count(),
            ];
            $recentLeads = Lead::with('organization')->latest()->take(10)->get();
        } else {
            $orgId = $user->organization_id;
            $stats = [
                'organizations' => 1,
                'leads' => Lead::where('organization_id', $orgId)->count(),
                'subscriptions' => Subscription::where('organization_id', $orgId)->where('status', 'active')->count(),
                'broadcasts' => Broadcast::where('organization_id', $orgId)->count(),
            ];
            $recentLeads = Lead::where('organization_id', $orgId)->latest()->take(10)->get();
        }

        return view('dashboard.index', compact('stats', 'recentLeads'));
    }
}
