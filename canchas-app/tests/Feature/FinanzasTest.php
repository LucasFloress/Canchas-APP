<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reserva;
use App\Models\VentaDespensa;
use App\Models\Producto;
use App\Models\Cancha;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class FinanzasTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TC-FIN-01: El dashboard suma correctamente reservas y ventas del día.
     */
    public function test_dashboard_suma_ingresos_de_reservas_y_ventas_del_dia(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        // Reserva pagada hoy: $5.000
        Reserva::factory()->create([
            'cancha_id'     => $cancha->id,
            'fecha_reserva' => Carbon::today(),
            'precio_total'  => 5000,
            'estado_pago'   => 'pagado',
            'estado_reserva'=> 'reservado',
            'metodo_pago'   => 'efectivo',
        ]);

        // Venta de despensa hoy: $1.000
        $producto = Producto::factory()->create(['stock' => 10, 'precio' => 1000]);
        VentaDespensa::create([
            'producto_id' => $producto->id,
            'cantidad'    => 1,
            'total_venta' => 1000,
            'metodo_pago' => 'efectivo',
        ]);

        // ACT
        $response = $this->actingAs($user)->get(route('dashboard'));

        // ASSERT: la vista recibe los totales correctos
        $response->assertStatus(200);
        $response->assertViewHas('totalReservasHoy', 5000.0);
        $response->assertViewHas('totalVentasHoy',   1000.0);
        $response->assertViewHas('totalDia',         6000.0);
    }

    /**
     * TC-FIN-01b: La seña cancelada NO suma al total del dashboard.
     */
    public function test_senia_cancelada_no_suma_al_total_del_dia(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        // Reserva CANCELADA con seña: no debe contar
        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::today(),
            'precio_total'   => 5000,
            'monto_senia'    => 5000,
            'estado_pago'    => 'pendiente',
            'estado_reserva' => 'cancelado',
            'metodo_pago'    => 'efectivo',
        ]);

        // Dos ventas de despensa: $1.000 y $2.000
        $producto = Producto::factory()->create(['stock' => 10, 'precio' => 1000]);
        VentaDespensa::create([
            'producto_id' => $producto->id,
            'cantidad'    => 1,
            'total_venta' => 1000,
            'metodo_pago' => 'efectivo',
        ]);
        VentaDespensa::create([
            'producto_id' => $producto->id,
            'cantidad'    => 2,
            'total_venta' => 2000,
            'metodo_pago' => 'transferencia',
        ]);

        // ACT
        $response = $this->actingAs($user)->get(route('dashboard'));

        // ASSERT: total = $3.000 (solo ventas, la seña cancelada no suma)
        $response->assertStatus(200);
        $response->assertViewHas('totalReservasHoy', 0.0);
        $response->assertViewHas('totalVentasHoy',   3000.0);
        $response->assertViewHas('totalDia',         3000.0);
    }

    /**
     * Reservas pendientes de cobro se cuentan correctamente.
     */
    public function test_cuenta_reservas_pendientes_de_cobro(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        // 2 reservas pendientes
        Reserva::factory()->count(2)->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::today(),
            'estado_pago'    => 'pendiente',
            'estado_reserva' => 'reservado',
        ]);

        // 1 reserva ya pagada (no debe contar como pendiente)
        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::today(),
            'estado_pago'    => 'pagado',
            'estado_reserva' => 'reservado',
            'metodo_pago'    => 'efectivo',
        ]);

        // ACT
        $response = $this->actingAs($user)->get(route('dashboard'));

        // ASSERT: solo 2 pendientes
        $response->assertStatus(200);
        $response->assertViewHas('reservasPendientes', 2);
    }

    /**
     * El reporte mensual suma correctamente reservas y ventas del mes.
     */
    public function test_reporte_mensual_suma_ingresos_del_mes(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        // Reserva pagada este mes: $10.000
        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::now()->startOfMonth(),
            'precio_total'   => 10000,
            'estado_pago'    => 'pagado',
            'estado_reserva' => 'reservado',
            'metodo_pago'    => 'transferencia',
        ]);

        // Venta de despensa este mes: $3.000
        $producto = Producto::factory()->create(['stock' => 10, 'precio' => 3000]);
        VentaDespensa::create([
            'producto_id' => $producto->id,
            'cantidad'    => 1,
            'total_venta' => 3000,
            'metodo_pago' => 'efectivo',
        ]);

        // ACT
        $response = $this->actingAs($user)->get(route('finanzas.reporte'));

        // ASSERT
        $response->assertStatus(200);
        $response->assertViewHas('totalReservas', 10000.0);
        $response->assertViewHas('totalVentas',   3000.0);
        $response->assertViewHas('totalGeneral',  13000.0);
    }

    /**
     * El reporte ignora reservas con estado_pago pendiente.
     */
    public function test_reporte_ignora_reservas_pendientes_de_pago(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        // Reserva pendiente: NO debe sumar
        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::now()->startOfMonth(),
            'precio_total'   => 5000,
            'estado_pago'    => 'pendiente',
            'estado_reserva' => 'reservado',
        ]);

        // Reserva pagada: SÍ debe sumar
        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::now()->startOfMonth(),
            'precio_total'   => 8000,
            'estado_pago'    => 'senia_pagada',
            'estado_reserva' => 'reservado',
            'metodo_pago'    => 'efectivo',
        ]);

        // ACT
        $response = $this->actingAs($user)->get(route('finanzas.reporte'));

        // ASSERT: solo suma la reserva con seña pagada
        $response->assertStatus(200);
        $response->assertViewHas('totalReservas', 8000.0);
        $response->assertViewHas('totalGeneral',  8000.0);
    }
}