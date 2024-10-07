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
            // Delete a column
            $table->dropColumn('bio');

            // Add a new column
            $table->text('user_bio')->nullable()->after('job_title');  // Adding user_bio after job_title column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Re-add the user_bio column when rolling back the migration
            $table->text('user_bio')->nullable();

            // Remove the bio column when rolling back the migration
            $table->dropColumn('bio');
        });
    }
};
