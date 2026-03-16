<?php

namespace Database\Factories;

use App\Models\Cancha;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cancha_id'      => Cancha::factory(),
            'fecha_reserva'  => $this->faker->dateTimeBetween('+1 day', '+30 days')->format('Y-m-d'),
            'horario_inicio' => '10:00:00',
            'horario_fin'    => '11:00:00',
            'cliente_nombre' => $this->faker->name(),
            'estado_reserva' => 'reservado',
            'precio_total'   => $this->faker->randomElement([3000, 4000, 5000]),
            'monto_senia'    => 0,
            'metodo_pago'    => $this->faker->randomElement(['efectivo', 'transferencia', null]),
            'estado_pago'    => 'pendiente',
        ];
    }

    // Estado: reserva cancelada
    public function cancelada(): static
    {
        return $this->state(['estado_reserva' => 'cancelado']);
    }

    // Estado: reserva con seña pagada
    public function conSenia(float $monto = 2000): static
    {
        return $this->state([
            'monto_senia' => $monto,
            'estado_pago' => 'senia_pagada',
        ]);
    }
}