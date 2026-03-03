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
        $plans = Plan::withCount('subscriptions')->orderBy('price_monthly')->get();
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
            'description' => 'nullable|string|max:500',
            'price' => 'nullable|numeric|min:0',
            'price_monthly' => 'required|integer|min:0',
            'interval' => 'required|in:month,year',
            'lead_limit' => 'nullable|integer|min:0',
            'broadcast_limit' => 'nullable|integer|min:0',
            'features_text' => 'nullable|string',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
            'trial_days' => 'nullable|integer|min:0|max:365',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['is_popular'] = $request->boolean('is_popular');
        $data['price'] = $data['price_monthly'];
        $data['trial_days'] = $data['trial_days'] ?? 7;
        $data['features'] = self::featuresTextToArray($request->input('features_text'));
        unset($data['features_text']);
        if ($data['is_popular']) {
            Plan::where('id', '!=', 0)->update(['is_popular' => false]);
        }
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
            'description' => 'nullable|string|max:500',
            'price' => 'nullable|numeric|min:0',
            'price_monthly' => 'required|integer|min:0',
            'interval' => 'required|in:month,year',
            'lead_limit' => 'nullable|integer|min:0',
            'broadcast_limit' => 'nullable|integer|min:0',
            'features_text' => 'nullable|string',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
            'trial_days' => 'nullable|integer|min:0|max:365',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['is_popular'] = $request->boolean('is_popular');
        $data['price'] = $data['price_monthly'];
        $data['trial_days'] = $data['trial_days'] ?? 7;
        $data['features'] = self::featuresTextToArray($request->input('features_text'));
        unset($data['features_text']);
        if ($data['is_popular']) {
            Plan::where('id', '!=', $plan->id)->update(['is_popular' => false]);
        }
        $plan->update($data);
        return redirect()->route('plans.index')->with('success', 'Plan updated.');
    }

    private static function featuresTextToArray(?string $text): array
    {
        if (empty(trim($text ?? ''))) {
            return [];
        }
        return array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", '', $text)))));
    }
}
