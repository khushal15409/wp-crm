<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function index(): View
    {
        $plans = Plan::withCount('subscriptions')->orderBy('price')->get();
        return view('plans.index', compact('plans'));
    }

    public function create(): View
    {
        return view('plans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plans,slug',
            'price' => 'required|numeric|min:0',
            'interval' => 'required|in:month,year',
            'lead_limit' => 'nullable|integer|min:0',
            'broadcast_limit' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Plan::create($data);
        return redirect()->route('plans.index')->with('success', 'Plan created.');
    }

    public function edit(Plan $plan): View
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plans,slug,' . $plan->id,
            'price' => 'required|numeric|min:0',
            'interval' => 'required|in:month,year',
            'lead_limit' => 'nullable|integer|min:0',
            'broadcast_limit' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $plan->update($data);
        return redirect()->route('plans.index')->with('success', 'Plan updated.');
    }
}
