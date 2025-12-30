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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin', 'parent'])->default('user')->after('email');
            $table->string('phone', 20)->nullable()->after('email');
            $table->boolean('require_email_verification')->default(false)->after('email_verified_at');
            $table->timestamp('last_signed_in')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'require_email_verification', 'last_signed_in']);
        });
    }
};
