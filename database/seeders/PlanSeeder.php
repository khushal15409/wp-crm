<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Seed the plans table. Idempotent: uses updateOrCreate by slug
     * so existing subscriptions and UI keep working.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'short_description' => 'Best for solo professionals getting started with WhatsApp leads.',
                'price' => 499,
                'interval' => 'month',
                'trial_days' => 7,
                'lead_limit' => 300,
                'broadcast_limit' => 0,
                'is_popular' => false,
                'is_active' => true,
                'features' => [
                    'WhatsApp lead inbox',
                    'Basic sales pipeline',
                    'Follow-up reminders',
                    'Notes & activity history',
                    'Single user access',
                    'Email support',
                ],
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'short_description' => 'Ideal for active sales agents and service-based teams.',
                'price' => 999,
                'interval' => 'month',
                'trial_days' => 7,
                'lead_limit' => null,
                'broadcast_limit' => 1000,
                'is_popular' => true,
                'is_active' => true,
                'features' => [
                    'Unlimited WhatsApp leads',
                    'Advanced sales pipeline',
                    'Broadcast messaging',
                    'Custom deal stages',
                    'Follow-up automation',
                    'Priority support',
                ],
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'short_description' => 'Built for teams, agencies & growing organizations.',
                'price' => 1999,
                'interval' => 'month',
                'trial_days' => 7,
                'lead_limit' => null,
                'broadcast_limit' => null,
                'is_popular' => false,
                'is_active' => true,
                'features' => [
                    'Everything in Pro',
                    'Team member access',
                    'Role-based permissions',
                    'Advanced analytics & reports',
                    'Dedicated support',
                ],
            ],
        ];

        foreach ($plans as $data) {
            $shortDescription = $data['short_description'];
            unset($data['short_description']);

            Plan::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'description' => $shortDescription,
                    'price_monthly' => $data['price'],
                ])
            );
        }
    }
}
