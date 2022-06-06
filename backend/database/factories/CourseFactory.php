<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Instructor;
use Carbon\Carbon;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'start' => Carbon::now(),
            'end' => Carbon::now()->addMonths(6),
            'instructor_id'=> Instructor::factory()
        ];
    }
}
