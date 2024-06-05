<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TrainerFactory extends Factory
{
    protected $model = Trainer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'specialization' => $this->faker->word,
            'join_date' => $this->faker->date(),
        ];
    }
}
