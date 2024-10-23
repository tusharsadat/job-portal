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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->require();
            $table->string('region');
            $table->string('company_name')->require();
            $table->string('job_type')->require();
            $table->string('vacancy')->nullable();
            $table->string('experience');
            $table->string('salary')->nullable();
            $table->string('gender')->nullable();
            $table->string('application_deadline')->require();
            $table->text('job_des')->nullable();
            $table->text('responsibilities')->nullable();
            $table->text('education_experience')->require();
            $table->text('other_benifits')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
