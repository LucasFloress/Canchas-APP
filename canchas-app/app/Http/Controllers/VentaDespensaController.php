<?php

namespace App\Http\Controllers;

use App\Models\VentaDespensa;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaDespensaController extends Controller
{
    public function index()
    {
        $ventas = VentaDespensa::with('producto')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('ventas-despensa.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::where('stock', '>', 0)->orderBy('categoria')->get();
        return view('ventas-despensa.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'metodo_pago' => 'required|string',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'Stock insuficiente. Stock disponible: ' . $producto->stock])->withInput();
        }

        $total = $producto->precio * $request->cantidad;

        VentaDespensa::create([
            'producto_id' => $request->producto_id,
            'cantidad'    => $request->cantidad,
            'total_venta' => $total,
            'metodo_pago' => $request->metodo_pago,
        ]);

        // Descontar stock automáticamente
        $producto->decrement('stock', $request->cantidad);

        return redirect()->route('ventas-despensa.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(VentaDespensa $ventaDespensa)
    {
        return redirect()->route('ventas-despensa.index');
    }

    public function edit(VentaDespensa $ventaDespensa)
    {
        return redirect()->route('ventas-despensa.index');
    }

    public function update(Request $request, VentaDespensa $ventaDespensa)
    {
        return redirect()->route('ventas-despensa.index');
    }

    public function destroy($id)
    {
        // Restaurar stock al anular venta
        
        // 1. Buscamos la venta
        $venta = \App\Models\VentaDespensa::findOrFail($id);

        // 2. ¡La validación clave! Solo devolvemos el stock si el producto aún existe
        if ($venta->producto) {
            $venta->producto->increment('stock', $venta->cantidad);
        }

        // 3. Eliminamos el registro de la venta
        $venta->delete();

        return redirect()->route('ventas-despensa.index')
            ->with('success', 'Venta eliminada correctamente.');
    }
}