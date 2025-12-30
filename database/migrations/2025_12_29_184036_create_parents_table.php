<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email', 320)->unique();
            $table->text('name');
            $table->string('phone', 20)->nullable();
            $table->enum('provider', ['google', 'apple', 'microsoft', 'manus']);
            $table->string('provider_id', 255);
            $table->text('profile_picture')->nullable();
            $table->timestamp('last_signed_in')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
