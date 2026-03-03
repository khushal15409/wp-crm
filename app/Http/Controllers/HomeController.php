<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page (public, no auth).
     */
    public function index(): View|RedirectResponse
    {
        $activePlans = Plan::where('is_active', true)
            ->orderByDesc('is_popular')
            ->orderBy('price_monthly')
            ->get();
        $trialDays = $activePlans->isEmpty() ? 7 : ((int) $activePlans->min('trial_days') ?: 7);
        return view('welcome', compact('activePlans', 'trialDays'));
    }
}

