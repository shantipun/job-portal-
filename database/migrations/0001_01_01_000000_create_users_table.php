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

            // Basic Info
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // User role: candidate / employer / admin
            $table->enum('role', ['user','employer','admin'])->default('user');

            // Optional profile info
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable(); // profile photo
   
            $table->string('location')->nullable();
           
            $table->text('bio')->nullable();

            // Verification and auth
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
