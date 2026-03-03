<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function index(Request $request): View
    {
        $query = Lead::with('organization');

        if (auth()->user()->hasRole('organization')) {
            $query->where('organization_id', auth()->user()->organization_id);
        }

        if ($request->filled('stage')) {
            $query->where('stage', $request->stage);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('phone', 'like', "%{$s}%")
                    ->orWhere('name', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%");
            });
        }

        $leads = $query->latest()->limit(5000)->get();
        return view('leads.index', compact('leads'));
    }

    public function create(): View|RedirectResponse
    {
        if (auth()->user()->hasRole('organization')) {
            abort(403, 'Leads are created only via WhatsApp. Manual creation is not allowed.');
        }
        $organizations = Organization::where('is_active', true)->orderBy('name')->get();
        return view('leads.create', compact('organizations'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->hasRole('organization')) {
            abort(403, 'Leads are created only via WhatsApp.');
        }
        $data = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'phone' => 'required|string|max:50',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'stage' => 'string|in:new,contacted,qualified,proposal,closed_won,closed_lost',
            'notes' => 'nullable|string',
        ]);
        $data['source'] = 'manual';
        Lead::create($data);
        return redirect()->route('leads.index')->with('success', 'Lead created.');
    }

    public function show(Lead $lead): View
    {
        $this->authorizeOrg($lead);
        $lead->load('organization', 'followUps');
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead): View
    {
        $this->authorizeOrg($lead);
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead): RedirectResponse
    {
        $this->authorizeOrg($lead);
        $data = $request->validate([
            'phone' => 'required|string|max:50',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'stage' => 'string|in:new,contacted,qualified,proposal,closed_won,closed_lost',
            'notes' => 'nullable|string',
        ]);
        $lead->update($data);
        return redirect()->route('leads.index')->with('success', 'Lead updated.');
    }

    private function authorizeOrg(Lead $lead): void
    {
        if (auth()->user()->hasRole('organization') && $lead->organization_id !== auth()->user()->organization_id) {
            abort(403);
        }
    }
}
