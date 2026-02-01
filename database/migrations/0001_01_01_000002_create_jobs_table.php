<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            // Job info
            $table->string('title');
            $table->text('description'); // job description
            $table->text('responsibilities')->nullable();
            $table->text('requirements')->nullable();

            // Company / Employer
            $table->unsignedBigInteger('employer_id'); // link to users table
            $table->string('company_name');
            $table->string('company_website')->nullable();

            // Job details
            $table->string('location');
            $table->string('salary')->nullable(); // can be text like "$50k - $70k"
            $table->enum('job_type', ['Full-Time','Part-Time','Contract','Internship','Remote'])->default('Full-Time');
            $table->date('last_date')->nullable(); // application deadline
            $table->boolean('is_active')->default(true);

            // Timestamps
            $table->timestamps();

            // Foreign key
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
