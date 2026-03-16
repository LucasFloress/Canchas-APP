<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cancha;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class PublicControllerTest extends TestCase
{
    use RefreshDatabase;

    // ─────────────────────────────────────────────
    // LANDING PAGE
    // ─────────────────────────────────────────────

    /**
     * La landing carga correctamente y muestra las canchas.
     */
    public function test_landing_carga_con_canchas(): void
    {
        // ARRANGE
        Cancha::factory()->count(3)->create();

        // ACT
        $response = $this->get(route('landing'));

        // ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('landing');
        $response->assertViewHas('canchas');
        $this->assertCount(3, $response->viewData('canchas'));
    }

    /**
     * La landing es accesible sin estar autenticado.
     */
    public function test_landing_es_publica_sin_autenticacion(): void
    {
        $response = $this->get(route('landing'));
        $response->assertStatus(200);
    }

    // ─────────────────────────────────────────────
    // API HORARIOS DISPONIBLES
    // ─────────────────────────────────────────────

    /**
     * La API devuelve las franjas horarias correctamente.
     */
    public function test_api_devuelve_franjas_horarias(): void
    {
        // ARRANGE
        $cancha = Cancha::factory()->create();
        $fecha  = Carbon::tomorrow()->format('Y-m-d');

        // ACT
        $response = $this->getJson(route('api.horarios', [
            'cancha_id' => $cancha->id,
            'fecha'     => $fecha,
        ]));

        // ASSERT: devuelve JSON con array de franjas
        $response->assertStatus(200);
        $response->assertJsonIsArray();
        $response->assertJsonStructure([
            '*' => ['inicio', 'fin', 'label', 'ocupada']
        ]);
    }

    /**
     * La API marca como ocupada una franja con reserva existente.
     */
    public function test_api_marca_franja_ocupada_correctamente(): void
    {
        // ARRANGE
        $cancha = Cancha::factory()->create();
        $fecha  = Carbon::tomorrow()->format('Y-m-d');

        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => $fecha,
            'horario_inicio' => '19:00:00',
            'horario_fin'    => '20:00:00',
            'estado_reserva' => 'reservado',
        ]);

        // ACT
        $response = $this->getJson(route('api.horarios', [
            'cancha_id' => $cancha->id,
            'fecha'     => $fecha,
        ]));

        // ASSERT: la franja 19:00-20:00 está ocupada
        $franjas = $response->json();
        $franja  = collect($franjas)->firstWhere('inicio', '19:00');

        $this->assertNotNull($franja, 'La franja 19:00 no fue encontrada en la respuesta.');
        $this->assertTrue($franja['ocupada'], 'La franja 19:00-20:00 debería estar marcada como ocupada.');
    }

    /**
     * La API NO marca como ocupada una franja de reserva cancelada.
     */
    public function test_api_ignora_reservas_canceladas(): void
    {
        // ARRANGE
        $cancha = Cancha::factory()->create();
        $fecha  = Carbon::tomorrow()->format('Y-m-d');

        Reserva::factory()->cancelada()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => $fecha,
            'horario_inicio' => '20:00:00',
            'horario_fin'    => '21:00:00',
        ]);

        // ACT
        $response = $this->getJson(route('api.horarios', [
            'cancha_id' => $cancha->id,
            'fecha'     => $fecha,
        ]));

        // ASSERT: la franja 20:00-21:00 está disponible
        $franjas = $response->json();
        $franja  = collect($franjas)->firstWhere('inicio', '20:00');

        $this->assertNotNull($franja);
        $this->assertFalse($franja['ocupada'], 'La franja de una reserva cancelada debería estar disponible.');
    }

    /**
     * La API rechaza una fecha en el pasado.
     */
    public function test_api_rechaza_fecha_pasada(): void
    {
        $cancha = Cancha::factory()->create();

        $response = $this->getJson(route('api.horarios', [
            'cancha_id' => $cancha->id,
            'fecha'     => Carbon::yesterday()->format('Y-m-d'),
        ]));

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fecha']);
    }

    // ─────────────────────────────────────────────
    // RESERVA PÚBLICA (store)
    // ─────────────────────────────────────────────

    /**
     * Un cliente puede hacer una reserva pública correctamente.
     */
    public function test_cliente_puede_hacer_reserva_publica(): void
    {
        // ARRANGE
        $cancha = Cancha::factory()->create(['precio_base' => 5000]);
        $fecha  = Carbon::tomorrow()->format('Y-m-d');

        // ACT
        $response = $this->post(route('reserva.publica.store'), [
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => $fecha,
            'horario_inicio' => '18:00',
            'horario_fin'    => '19:00',
            'cliente_nombre' => 'Juan García',
            'precio_total'   => 5000,
        ]);

        // ASSERT: redirige a landing con mensaje de éxito
        $response->assertRedirect(route('landing'));
        $response->assertSessionHas('success');

        // La reserva fue guardada con los valores por defecto correctos
        $this->assertDatabaseHas('reservas', [
            'cancha_id'      => $cancha->id,
            'cliente_nombre' => 'Juan García',
            'horario_inicio' => '18:00:00',
            'estado_reserva' => 'reservado',
            'estado_pago'    => 'pendiente',
            'monto_senia'    => 0,
        ]);
    }

    /**
     * La reserva pública rechaza horarios solapados.
     */
    public function test_reserva_publica_rechaza_solapamiento(): void
    {
        // ARRANGE
        $cancha = Cancha::factory()->create();
        $fecha  = Carbon::tomorrow()->format('Y-m-d');

        Reserva::factory()->create([
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => $fecha,
            'horario_inicio' => '18:00:00',
            'horario_fin'    => '19:00:00',
            'estado_reserva' => 'reservado',
        ]);

        // ACT: intentar reservar el mismo horario
        $response = $this->post(route('reserva.publica.store'), [
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => $fecha,
            'horario_inicio' => '18:00',
            'horario_fin'    => '19:00',
            'cliente_nombre' => 'Pedro López',
            'precio_total'   => 5000,
        ]);

        // ASSERT: error y solo existe 1 reserva en DB
        $response->assertSessionHasErrors(['horario_inicio']);
        $this->assertDatabaseCount('reservas', 1);
    }

    /**
     * La reserva pública rechaza una fecha pasada.
     */
    public function test_reserva_publica_rechaza_fecha_pasada(): void
    {
        $cancha = Cancha::factory()->create();

        $response = $this->post(route('reserva.publica.store'), [
            'cancha_id'      => $cancha->id,
            'fecha_reserva'  => Carbon::yesterday()->format('Y-m-d'),
            'horario_inicio' => '18:00',
            'horario_fin'    => '19:00',
            'cliente_nombre' => 'Test Usuario',
            'precio_total'   => 5000,
        ]);

        $response->assertSessionHasErrors(['fecha_reserva']);
        $this->assertDatabaseCount('reservas', 0);
    }

    /**
     * La reserva pública requiere todos los campos obligatorios.
     */
    public function test_reserva_publica_valida_campos_requeridos(): void
    {
        $response = $this->post(route('reserva.publica.store'), []);

        $response->assertSessionHasErrors([
            'cancha_id',
            'fecha_reserva',
            'horario_inicio',
            'horario_fin',
            'cliente_nombre',
            'precio_total',
        ]);
    }
}