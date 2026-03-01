<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FollowUpController extends Controller
{
    public function index(Request $request): View
    {
        $query = FollowUp::with(['lead', 'organization', 'user']);

        if (auth()->user()->hasRole('organization')) {
            $query->where('organization_id', auth()->user()->organization_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $followUps = $query->where('due_at', '>=', now()->startOfDay())->orderBy('due_at')->paginate(15);
        return view('follow-ups.index', compact('followUps'));
    }

    public function create(): View
    {
        $leadQuery = Lead::query();
        if (auth()->user()->hasRole('organization')) {
            $leadQuery->where('organization_id', auth()->user()->organization_id);
        }
        $leads = $leadQuery->orderBy('name')->get();
        return view('follow-ups.create', compact('leads'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'due_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);
        $lead = Lead::findOrFail($data['lead_id']);
        if ($user->hasRole('organization') && $lead->organization_id !== $user->organization_id) {
            abort(403);
        }
        $data['organization_id'] = $lead->organization_id;
        $data['user_id'] = $user->id;
        $data['status'] = 'pending';
        FollowUp::create($data);
        return redirect()->route('follow-ups.index')->with('success', 'Follow-up created.');
    }

    public function updateStatus(FollowUp $followUp, Request $request): RedirectResponse
    {
        if (auth()->user()->hasRole('organization') && $followUp->organization_id !== auth()->user()->organization_id) {
            abort(403);
        }
        $followUp->update(['status' => $request->validate(['status' => 'required|in:pending,done,missed'])['status']]);
        return back()->with('success', 'Status updated.');
    }
}
