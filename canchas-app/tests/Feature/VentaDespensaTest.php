<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Producto;
use App\Models\VentaDespensa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VentaDespensaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * El stock se descuenta correctamente al registrar una venta.
     */
    public function test_descuenta_stock_al_registrar_venta(): void
    {
        // ARRANGE
        $user     = User::factory()->create();
        $producto = Producto::factory()->create([
            'nombre' => 'Gatorade',
            'stock'  => 10,
            'precio' => 1500,
        ]);

        // ACT: vender 3 unidades
        $response = $this->actingAs($user)->post(route('ventas-despensa.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 3,
            'metodo_pago' => 'efectivo',
        ]);

        // ASSERT: redirige OK y el stock bajó de 10 a 7
        $response->assertRedirect();
        $this->assertDatabaseHas('productos', [
            'id'    => $producto->id,
            'stock' => 7,
        ]);
    }

    /**
     * TC-DES-01: Rechaza venta cuando el stock es insuficiente.
     */
    public function test_rechaza_venta_con_stock_insuficiente(): void
    {
        // ARRANGE
        $user     = User::factory()->create();
        $producto = Producto::factory()->create([
            'stock' => 2,
        ]);

        // ACT: intentar vender 3 (más de lo disponible)
        $response = $this->actingAs($user)->post(route('ventas-despensa.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 3,
            'metodo_pago' => 'efectivo',
        ]);

        // ASSERT: error de validación y stock sin cambios
        $response->assertSessionHasErrors(['cantidad']);
        $this->assertDatabaseHas('productos', [
            'id'    => $producto->id,
            'stock' => 2,
        ]);
        // No se creó ninguna venta
        $this->assertDatabaseCount('venta_despensas', 0);
    }

    /**
     * Rechaza venta cuando el stock es exactamente 0.
     */
    public function test_rechaza_venta_con_stock_en_cero(): void
    {
        // ARRANGE
        $user     = User::factory()->create();
        $producto = Producto::factory()->sinStock()->create();

        // ACT
        $response = $this->actingAs($user)->post(route('ventas-despensa.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 1,
            'metodo_pago' => 'efectivo',
        ]);

        // ASSERT
        $response->assertSessionHasErrors(['cantidad']);
        $this->assertDatabaseCount('venta_despensas', 0);
    }

    /**
     * El stock se restaura al cancelar (eliminar) una venta.
     */
    public function test_restaura_stock_al_cancelar_venta(): void
    {
        // ARRANGE
        $user     = User::factory()->create();
        $producto = Producto::factory()->create(['stock' => 10]);

        // Registrar una venta primero
        $this->actingAs($user)->post(route('ventas-despensa.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 3,
            'metodo_pago' => 'efectivo',
        ]);

        $venta = VentaDespensa::first();

        // ACT: cancelar la venta
        $response = $this->actingAs($user)->delete(
            route('ventas-despensa.destroy', ['ventas_despensa' => $venta->id])
        );

        // ASSERT: el stock vuelve a 10
        $response->assertRedirect();
        $this->assertDatabaseHas('productos', [
            'id'    => $producto->id,
            'stock' => 10,
        ]);
        $this->assertDatabaseCount('venta_despensas', 0);
    }
}