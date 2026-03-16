<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CanchaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'numero'      => $this->faker->unique()->numberBetween(1, 20),
            'precio_base' => $this->faker->randomElement([3000, 4000, 5000, 6000]),
        ];
    }
}