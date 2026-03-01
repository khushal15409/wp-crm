<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function index(Request $request): View
    {
        $query = Subscription::with(['organization', 'plan']);

        if (auth()->user()->hasRole('organization')) {
            $query->where('organization_id', auth()->user()->organization_id);
        }

        $subscriptions = $query->latest()->paginate(15);
        return view('subscriptions.index', compact('subscriptions'));
    }
}
