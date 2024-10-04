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
            $table->string('cv')->default('No CV')->after('password');
            $table->string('job_title')->default('No job title')->after('cv');
            $table->string('bio')->default('No bio')->after('job_title');
            $table->string('facebook')->default('No facebook')->after('bio');
            $table->string('linkedin')->default('No linkedin')->after('facebook');
            $table->string('twitter')->default('No twitter')->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cv', 'job_title', 'bio', 'facebook', 'linkedin', 'twitter']);  // Drop the columns if rolled back
        });
    }
};
