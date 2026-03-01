<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $query = User::with('organization');
        if (auth()->user()->hasRole('organization')) {
            $query->where('organization_id', auth()->user()->organization_id);
        }
        $users = $query->latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $organizations = Organization::where('is_active', true)->orderBy('name')->get();
        return view('users.create', compact('organizations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'organization_id' => 'required_if:role,organization|nullable|exists:organizations,id',
            'role' => 'required|in:super_admin,organization',
        ]);
        $orgId = $data['role'] === 'super_admin' ? null : $data['organization_id'];
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'organization_id' => $orgId,
        ]);
        $newUser->assignRole($data['role']);
        return redirect()->route('users.index')->with('success', 'User created.');
    }
}
