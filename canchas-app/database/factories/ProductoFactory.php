<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre'    => $this->faker->randomElement(['Gatorade', 'Agua', 'Coca Cola', 'Sprite', 'Alfajor', 'Papas Fritas']),
            'categoria' => $this->faker->randomElement(['bebidas', 'snacks', 'lacteos']),
            'stock'     => 10,
            'precio'    => $this->faker->randomElement([500, 800, 1000, 1500, 2000]),
        ];
    }

    // Estado: sin stock
    public function sinStock(): static
    {
        return $this->state(['stock' => 0]);
    }

    // Estado: stock bajo (1 unidad)
    public function stockBajo(): static
    {
        return $this->state(['stock' => 1]);
    }
}