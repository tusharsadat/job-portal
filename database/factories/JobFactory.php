<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => fake()->jobTitle(),
            'region' => fake()->city(),
            'company_name' => fake()->company(),
            'job_type' => fake()->randomElement(['Full Time', 'Part Time']),
            'vacancy' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'experience' => fake()->randomElement(['2 to 3 year(s)', '1 year(s)']),
            'salary' => fake()->randomElement(['20000', '30000']),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'application_deadline' => fake()->date($format = 'd-m-Y'),
            'job_des' => fake()->realText(),
            'responsibilities' => fake()->realText(),
            'education_experience' => fake()->realText(),
            'other_benifits' => fake()->realText(),
            'image' => fake()->imageUrl(),
            'category_id' => Category::factory(),

        ];
    }
}
