<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Plan;
use App\Models\Lead;
use App\Models\FollowUp;
use App\Models\Broadcast;
use App\Models\Setting;
use App\Models\WhatsappAccount;
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
        if (!$superAdmin->hasRole('super_admin')) {
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
            if (!$user->hasRole('organization')) {
                $user->assignRole('organization');
            }
        }

        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'description' => 'Best for solo professionals getting started with WhatsApp leads.',
                'price' => 299,
                'price_monthly' => 299,
                'interval' => 'month',
                'lead_limit' => 300,
                'broadcast_limit' => 50,
                'features' => ['CRM inbox & pipeline', 'Follow-up reminders', 'Notes & activity history', 'Email support'],
                'is_active' => true,
                'is_popular' => false,
                'trial_days' => 7,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'Ideal for active sales agents and service-based teams.',
                'price' => 599,
                'price_monthly' => 599,
                'interval' => 'month',
                'lead_limit' => null,
                'broadcast_limit' => null,
                'features' => ['Advanced pipeline', 'Broadcast messaging', 'Custom deal stages', 'Priority support'],
                'is_active' => true,
                'is_popular' => true,
                'trial_days' => 7,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Built for teams, agencies & growing organizations.',
                'price' => 999,
                'price_monthly' => 999,
                'interval' => 'month',
                'lead_limit' => null,
                'broadcast_limit' => null,
                'features' => ['Everything in Pro', 'Team member access', 'Role-based permissions', 'Advanced analytics & reports', 'Dedicated support'],
                'is_active' => true,
                'is_popular' => false,
                'trial_days' => 7,
            ],
        ];

        foreach ($plans as $p) {
            Plan::updateOrCreate(
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

            // Seed a WhatsappAccount per organization (dummy data)
            WhatsappAccount::firstOrCreate(
                ['organization_id' => $org->id],
                [
                    'phone_number' => '+910000000' . $org->id,
                    'account_id' => 'WA-ACC-' . $org->slug,
                    'status' => 'connected',
                ]
            );

            // Seed some leads for each organization
            for ($i = 1; $i <= 5; $i++) {
                $lead = Lead::firstOrCreate(
                    [
                        'organization_id' => $org->id,
                        'phone' => '+910000' . $org->id . sprintf('%03d', $i),
                    ],
                    [
                        'name' => 'Lead ' . $i . ' - ' . $org->name,
                        'email' => 'lead' . $i . '@' . $org->slug . '.test',
                        'source' => 'whatsapp',
                        'stage' => $i === 1 ? 'new' : 'contacted',
                        'notes' => 'Demo lead seeded for ' . $org->name,
                    ]
                );

                // One follow-up per lead, assigned to the org user
                $orgUser = $org->users()->first();
                if ($orgUser) {
                    FollowUp::firstOrCreate(
                        [
                            'organization_id' => $org->id,
                            'lead_id' => $lead->id,
                            'user_id' => $orgUser->id,
                        ],
                        [
                            'due_at' => now()->addDays($i),
                            'status' => 'pending',
                            'notes' => 'Follow up with ' . ($lead->name ?? $lead->phone),
                        ]
                    );
                }
            }

            // Seed a sample broadcast per organization
            Broadcast::firstOrCreate(
                [
                    'organization_id' => $org->id,
                    'name' => 'Welcome Campaign',
                ],
                [
                    'message' => 'Welcome to WP-CRM demo broadcast for ' . $org->name . '.',
                    'status' => 'draft',
                    'scheduled_at' => now()->addDay(),
                    'sent_at' => null,
                    'recipients_count' => 0,
                ]
            );
        }

        // Seed basic system settings (safe dummy values)
        Setting::set('app_name', 'WP-CRM Demo', 'app');
        Setting::set('support_email', 'support@wp-crm.test', 'app');
        Setting::set('whatsapp_base_url', 'https://graph.facebook.com/v21.0', 'whatsapp');
        Setting::set('whatsapp_phone_number_id', '1234567890', 'whatsapp');
        Setting::set('whatsapp_business_account_id', '987654321', 'whatsapp');
        // do not set real tokens here; leave empty for manual configuration
    }
}
