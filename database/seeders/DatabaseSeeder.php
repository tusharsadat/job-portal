<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'id' => 3,
            'name' => 'sadat',
            'email' => 'sadat@example.com',
            'password' => bcrypt('123.321A'),
            'email_verified_at' => time()
        ]);

        //Job::factory()->count(50)->create();

        // Create 10 categories, and for each category, create 5 jobs
        Category::factory(10) // Create 10 categories
            ->hasJobs(5) // Each category will have 5 jobs
            ->create();
    }
}
