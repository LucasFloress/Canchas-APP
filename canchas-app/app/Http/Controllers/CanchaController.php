<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use Illuminate\Http\Request;

class CanchaController extends Controller
{
    public function index()
    {
        $canchas = Cancha::withCount('reservas')->get();
        return view('canchas.index', compact('canchas'));
    }

    public function create()
    {
        return view('canchas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:255',
            'precio_base'     => 'required|numeric|min:0',
        ]);

        Cancha::create($request->only('numero', 'precio_base'));

        return redirect()->route('canchas.index')->with('success', 'Cancha creada correctamente.');
    }

    public function edit(Cancha $cancha)
    {
        return view('canchas.edit', compact('cancha'));
    }

    public function update(Request $request, Cancha $cancha)
    {
        $request->validate([
            'numero' => 'required|string|max:255',
            'precio_base'     => 'required|numeric|min:0',
        ]);

        $cancha->update($request->only('numero', 'precio_base'));

        return redirect()->route('canchas.index')->with('success', 'Cancha actualizada correctamente.');
    }

    public function destroy(Cancha $cancha)
    {
        if ($cancha->reservas()->where('estado_reserva', 'reservado')->exists()) {
            return redirect()->route('canchas.index')->with('error', 'No se puede eliminar una cancha con reservas activas.');
        }

        $cancha->delete();
        return redirect()->route('canchas.index')->with('success', 'Cancha eliminada.');
    }

    public function show(Cancha $cancha)
    {
        return redirect()->route('canchas.index');
    }
}