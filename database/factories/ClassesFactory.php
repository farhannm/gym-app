<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    protected $model = Classes::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'trainer_id' => Trainer::factory(), // Create and use a Trainer instance
        ];
    }
}
