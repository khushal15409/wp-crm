<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('business_type')->nullable()->after('name');
            $table->string('city')->nullable()->after('address');
            $table->unsignedInteger('trial_lead_limit')->nullable()->after('is_active');
            $table->boolean('is_trial')->default(false)->after('trial_lead_limit');
            $table->timestamp('trial_ends_at')->nullable()->after('is_trial');
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn([
                'business_type',
                'city',
                'trial_lead_limit',
                'is_trial',
                'trial_ends_at',
            ]);
        });
    }
};

