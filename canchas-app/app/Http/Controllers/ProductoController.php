<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
    $query = Producto::query();

    // Filtro por categoría
    if ($request->filled('categoria')) {
        $query->where('categoria', $request->categoria);
    }

    // Filtro por stock
    if ($request->filled('stock')) {
        match($request->stock) {
            'disponible' => $query->where('stock', '>', 5),
            'bajo'       => $query->where('stock', '>', 0)->where('stock', '<=', 5),
            'sin_stock'  => $query->where('stock', 0),
            default      => null
        };
    }

    $productos   = $query->orderBy('categoria')->orderBy('nombre')->get();
    $categorias  = Producto::select('categoria')->distinct()->orderBy('categoria')->pluck('categoria');

    return view('productos.index', compact('productos', 'categorias'));

    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'stock'     => 'required|integer|min:0',
            'precio'    => 'required|numeric|min:0',
        ]);

        Producto::create($request->only('nombre', 'categoria', 'stock', 'precio'));

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'stock'     => 'required|integer|min:0',
            'precio'    => 'required|numeric|min:0',
        ]);

        $producto->update($request->only('nombre', 'categoria', 'stock', 'precio'));

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }

    public function show(Producto $producto)
    {
        return redirect()->route('productos.index');
    }
}