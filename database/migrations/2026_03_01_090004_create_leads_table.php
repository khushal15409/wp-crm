<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('whatsapp_id')->nullable(); // from webhook
            $table->string('phone');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('source')->default('whatsapp'); // whatsapp, manual (super_admin only)
            $table->string('stage')->default('new'); // new, contacted, qualified, proposal, closed_won, closed_lost
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
