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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('code_verified_mail')->nullable();
            $table->timestamp('code_verified_mail_sent_at')->nullable();
            $table->string('password');
            $table->string('role')->nullable();
            $table->string('status')->default('off');
            $table->string('foto')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->rememberToken();
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
