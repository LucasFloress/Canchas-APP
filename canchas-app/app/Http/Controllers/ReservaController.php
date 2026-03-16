<?php
namespace App\Http\Controllers;
use App\Models\Reserva;
use App\Models\Cancha;
use Illuminate\Http\Request;
class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('cancha')
            ->orderBy('fecha_reserva', 'desc')
            ->orderBy('horario_inicio', 'asc')
            ->paginate(15);
        return view('reservas.index', compact('reservas'));
    }
    public function create()
    {
        $canchas = Cancha::all();
        return view('reservas.create', compact('canchas'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cancha_id'      => 'required|exists:canchas,id',
            'fecha_reserva'  => 'required|date',
            'horario_inicio' => 'required',
            'horario_fin'    => 'required|after:horario_inicio',
            'cliente_nombre' => 'required|string|max:255',
            'precio_total'   => 'required|numeric|min:0',
            'monto_senia'    => 'nullable|numeric|min:0',
            'metodo_pago'    => 'nullable|string',
            'estado_pago'    => 'required|in:pendiente,senia_pagada,pagado',
        ]);

        // Verificar solapamiento de horarios
        $solapamiento = Reserva::where('cancha_id', $validated['cancha_id'])
            ->where('fecha_reserva', $validated['fecha_reserva'])
            ->where('estado_reserva', '!=', 'cancelado')
            ->where(function ($q) use ($validated) {
                $q->where('horario_inicio', '<', $validated['horario_fin'])
                  ->where('horario_fin',    '>', $validated['horario_inicio']);
            })->exists();

        if ($solapamiento) {
            return back()->withErrors(['horario_inicio' => 'Ya existe una reserva en ese horario para esa cancha.'])->withInput();
        }

        $validated['monto_senia']    = $validated['monto_senia'] ?? 0;
        $validated['estado_reserva'] = 'reservado';
        Reserva::create($validated);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
    }
    public function show(Reserva $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }
    public function edit(Reserva $reserva)
    {
        $canchas = Cancha::all();
        return view('reservas.edit', compact('reserva', 'canchas'));
    }
    public function update(Request $request, Reserva $reserva)
    {
        $validated = $request->validate([
            'cancha_id'      => 'required|exists:canchas,id',
            'fecha_reserva'  => 'required|date',
            'horario_inicio' => 'required',
            'horario_fin'    => 'required|after:horario_inicio',
            'cliente_nombre' => 'required|string|max:255',
            'precio_total'   => 'required|numeric|min:0',
            'monto_senia'    => 'nullable|numeric|min:0',
            'metodo_pago'    => 'nullable|string',
            'estado_pago'    => 'required|in:pendiente,senia_pagada,pagado',
            'estado_reserva' => 'required|in:disponible,reservado,cancelado,completado',
        ]);

        // Verificar solapamiento excluyendo la reserva actual
        $solapamiento = Reserva::where('cancha_id', $validated['cancha_id'])
            ->where('fecha_reserva', $validated['fecha_reserva'])
            ->where('estado_reserva', '!=', 'cancelado')
            ->where('id', '!=', $reserva->id)
            ->where(function ($q) use ($validated) {
                $q->where('horario_inicio', '<', $validated['horario_fin'])
                  ->where('horario_fin',    '>', $validated['horario_inicio']);
            })->exists();

        if ($solapamiento) {
            return back()->withErrors(['horario_inicio' => 'Ya existe una reserva en ese horario para esa cancha.'])->withInput();
        }

        $validated['monto_senia'] = $validated['monto_senia'] ?? 0;
        $reserva->update($validated);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }
    public function destroy(Reserva $reserva)
    {
        $reserva->update(['estado_reserva' => 'cancelado']);
        return redirect()->route('reservas.index')->with('success', 'Reserva cancelada.');
    }
}