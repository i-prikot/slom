<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_requests', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('phone_display');
            $table->string('name')->nullable();
            $table->string('source');
            $table->string('form_type');
            $table->boolean('consent');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_requests');
    }
};
