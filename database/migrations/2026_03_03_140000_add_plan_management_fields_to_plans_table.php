<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->unsignedInteger('price_monthly')->default(0)->after('price')->comment('INR, integer');
            $table->string('description', 500)->nullable()->after('slug');
            $table->json('features')->nullable()->after('description');
            $table->boolean('is_popular')->default(false)->after('is_active');
            $table->unsignedTinyInteger('trial_days')->default(7)->after('is_popular');
        });

        // Backfill price_monthly from price for existing rows
        foreach (\DB::table('plans')->get() as $plan) {
            \DB::table('plans')->where('id', $plan->id)->update([
                'price_monthly' => (int) round($plan->price ?? 0),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn(['price_monthly', 'description', 'features', 'is_popular', 'trial_days']);
        });
    }
};
