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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('avatar')->default(asset('placeholders/user/avatar.png'));
            $table->string('password');
            $table->string('about')->nullable();
            $table->rememberToken();
            $table->string('verification_code')->nullable();
            $table->string('verification_code_expiry')->nullable();
            $table->tinyInteger('email_status')->default(EMAIL_NOT_VERIFIED);
            $table->tinyInteger('tfa_status')->default(DISABLED);
            $table->boolean('tfa_verified')->default(false);
            $table->tinyInteger('status')->default(APPROVED);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_password_reset_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
