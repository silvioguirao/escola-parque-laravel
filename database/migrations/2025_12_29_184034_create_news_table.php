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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300);
            $table->string('slug', 300)->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->text('cover_image_url')->nullable();
            $table->text('cover_image_key')->nullable();
            $table->enum('category', ['announcement', 'event', 'achievement', 'general'])->default('general');
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
