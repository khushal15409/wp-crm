<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WpCrmSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@wp-crm.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'organization_id' => null,
            ]
        );
        if (! $superAdmin->hasRole('super_admin')) {
            $superAdmin->assignRole('super_admin');
        }

        $orgs = [
            ['name' => 'Acme Realty', 'slug' => 'acme-realty'],
            ['name' => 'Best Properties', 'slug' => 'best-properties'],
            ['name' => 'Sunrise Sales', 'slug' => 'sunrise-sales'],
        ];

        $organizations = [];
        foreach ($orgs as $o) {
            $organizations[] = Organization::firstOrCreate(
                ['slug' => $o['slug']],
                ['name' => $o['name'], 'is_active' => true]
            );
        }

        foreach ($organizations as $org) {
            $user = User::firstOrCreate(
                ['email' => 'user@' . $org->slug . '.test'],
                [
                    'name' => 'User ' . $org->name,
                    'password' => Hash::make('password'),
                    'organization_id' => $org->id,
                ]
            );
            if (! $user->hasRole('organization')) {
                $user->assignRole('organization');
            }
        }

        $plans = [
            ['name' => 'Basic', 'slug' => 'basic', 'price' => 19, 'interval' => 'month', 'lead_limit' => 1000, 'broadcast_limit' => 100],
            ['name' => 'Pro', 'slug' => 'pro', 'price' => 49, 'interval' => 'month', 'lead_limit' => 5000, 'broadcast_limit' => 500],
            ['name' => 'Premium', 'slug' => 'premium', 'price' => 99, 'interval' => 'month', 'lead_limit' => null, 'broadcast_limit' => null],
        ];

        foreach ($plans as $p) {
            Plan::firstOrCreate(
                ['slug' => $p['slug']],
                array_merge($p, ['is_active' => true])
            );
        }

        $proPlan = Plan::where('slug', 'pro')->first();
        foreach ($organizations as $org) {
            Subscription::firstOrCreate(
                [
                    'organization_id' => $org->id,
                    'plan_id' => $proPlan->id,
                ],
                [
                    'starts_at' => now(),
                    'ends_at' => now()->addMonth(),
                    'status' => 'active',
                ]
            );
        }
    }
}
