<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->constrained()->restrictOnDelete();
            $table->rememberToken();
            $table->text('google2fa_secret')->nullable();
            $table->boolean('google2fa_enabled')->default(false);
            $table->timestamp('password_changed_at')->nullable();
            $table->timestamp('password_expires_at')->nullable();
            $table->boolean('password_must_be_changed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
