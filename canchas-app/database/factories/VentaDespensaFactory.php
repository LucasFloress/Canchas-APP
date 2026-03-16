<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class VentaDespensaFactory extends Factory
{
    public function definition(): array
    {
        $producto = Producto::factory()->create();

        return [
            'producto_id'  => $producto->id,
            'cantidad'     => 1,
            'total_venta'  => $producto->precio,
            'metodo_pago'  => $this->faker->randomElement(['efectivo', 'transferencia', 'debito']),
        ];
    }
}