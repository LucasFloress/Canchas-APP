<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cancha;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TC-RES-01: Rechaza reserva que solapa con una existente.
     */
    public function test_rechaza_reserva_con_horario_solapado(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => '2025-12-01',
            'horario_inicio' => '10:00:00',
            'horario_fin'    => '11:00:00',
        ]);

        // ACT: nueva reserva solapa (10:45 - 11:45)
        $response = $this->actingAs($user)->post(route('reservas.store'), [
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => '2025-12-01',
            'horario_inicio' => '10:45',
            'horario_fin'    => '11:45',
            'cliente_nombre' => 'Juan Perez',
            'precio_total'   => 5000,
            'estado_pago'    => 'pendiente',
        ]);

        // ASSERT: rechazado, sólo existe 1 reserva en DB
        $response->assertSessionHasErrors(['horario_inicio']);
        $this->assertDatabaseCount('reservas', 1);
    }

    /**
     * TC-RES-02: Permite reservas exactamente contiguas.
     */
    public function test_permite_reservas_contiguas(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => '2025-12-01',
            'horario_inicio' => '10:00:00',
            'horario_fin'    => '11:00:00',
        ]);

        // ACT: nueva reserva empieza exactamente cuando termina la anterior
        $response = $this->actingAs($user)->post(route('reservas.store'), [
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => '2025-12-01',
            'horario_inicio' => '11:00',
            'horario_fin'    => '12:00',
            'cliente_nombre' => 'Maria Lopez',
            'precio_total'   => 5000,
            'estado_pago'    => 'pendiente',
        ]);

        // ASSERT: redirige OK y hay 2 reservas en DB
        $response->assertRedirect(route('reservas.index'));
        $this->assertDatabaseCount('reservas', 2);
    }

    /**
     * No solapa si la reserva existente está cancelada.
     */
    public function test_ignora_reservas_canceladas_al_verificar_solapamiento(): void
    {
        // ARRANGE
        $user   = User::factory()->create();
        $cancha = Cancha::factory()->create();

        Reserva::factory()->cancelada()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => '2025-12-01',
            'horario_inicio' => '10:00:00',
            'horario_fin'    => '11:00:00',
        ]);

        // ACT: misma cancha, misma fecha y horario — pero la existente está cancelada
        $response = $this->actingAs($user)->post(route('reservas.store'), [
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => '2025-12-01',
            'horario_inicio' => '10:00',
            'horario_fin'    => '11:00',
            'cliente_nombre' => 'Carlos Ruiz',
            'precio_total'   => 5000,
            'estado_pago'    => 'pendiente',
        ]);

        // ASSERT: debe permitirse porque la que ocupa el horario está cancelada
        $response->assertRedirect(route('reservas.index'));
        $this->assertDatabaseCount('reservas', 2);
    }
}