<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'organization_name' => ['required', 'string', 'max:255'],
            'business_type' => ['nullable', 'string', 'max:255'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($request) {
            $slugBase = Str::slug($request->organization_name);
            $slug = $slugBase;
            $suffix = 1;
            while (Organization::where('slug', $slug)->exists()) {
                $slug = $slugBase.'-'.$suffix++;
            }

            $organization = Organization::create([
                'name' => $request->organization_name,
                'slug' => $slug,
                'email' => $request->email,
                'phone' => $request->whatsapp_number,
                'business_type' => $request->business_type,
                'is_active' => true,
                'is_trial' => true,
                'trial_ends_at' => now()->addDays(7),
            ]);

            $plan = Plan::where('slug', 'basic')
                ->orWhere('slug', 'trial')
                ->first() ?? Plan::first();

            if ($plan) {
                Subscription::create([
                    'organization_id' => $organization->id,
                    'plan_id' => $plan->id,
                    'starts_at' => now(),
                    'ends_at' => now()->addDays(7),
                    'status' => 'trial',
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'organization_id' => $organization->id,
            ]);

            $user->assignRole('organization');

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
