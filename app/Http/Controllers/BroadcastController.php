<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BroadcastController extends Controller
{
    public function index(): View
    {
        $query = Broadcast::with('organization');

        if (auth()->user()->hasRole('organization')) {
            $query->where('organization_id', auth()->user()->organization_id);
        }

        $broadcasts = $query->latest()->limit(5000)->get();
        return view('broadcasts.index', compact('broadcasts'));
    }

    public function create(): View
    {
        return view('broadcasts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $orgId = $user->hasRole('super_admin') ? $request->validate(['organization_id' => 'required|exists:organizations,id'])['organization_id'] : $user->organization_id;
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'string|in:draft,scheduled',
        ]);
        $data['organization_id'] = $orgId;
        Broadcast::create($data);
        return redirect()->route('broadcasts.index')->with('success', 'Broadcast created.');
    }

    public function show(Broadcast $broadcast): View
    {
        if (auth()->user()->hasRole('organization') && $broadcast->organization_id !== auth()->user()->organization_id) {
            abort(403);
        }
        return view('broadcasts.show', compact('broadcast'));
    }
}
