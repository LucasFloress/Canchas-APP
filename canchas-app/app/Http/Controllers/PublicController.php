<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicController extends Controller
{
    /**
     * Carga la Landing Page con las canchas disponibles.
     */
    public function index()
    {
        $canchas = Cancha::orderBy('numero')->get();
        return view('landing', compact('canchas'));
    }

    /**
     * API: Devuelve los horarios ocupados para una cancha y fecha dadas.
     * Usado por el JS del frontend para deshabilitar franjas horarias.
     */
    public function getHorariosDisponibles(Request $request)
    {
        $request->validate([
            'cancha_id' => 'required|exists:canchas,id',
            'fecha'     => 'required|date|after_or_equal:today',
        ]);

        // Franjas horarias fijas disponibles (se pueden ajustar)
        $franjas = [
            ['inicio' => '08:00', 'fin' => '09:00'],
            ['inicio' => '09:00', 'fin' => '10:00'],
            ['inicio' => '10:00', 'fin' => '11:00'],
            ['inicio' => '11:00', 'fin' => '12:00'],
            ['inicio' => '14:00', 'fin' => '15:00'],
            ['inicio' => '15:00', 'fin' => '16:00'],
            ['inicio' => '16:00', 'fin' => '17:00'],
            ['inicio' => '17:00', 'fin' => '18:00'],
            ['inicio' => '18:00', 'fin' => '19:00'],
            ['inicio' => '19:00', 'fin' => '20:00'],
            ['inicio' => '20:00', 'fin' => '21:00'],
            ['inicio' => '21:00', 'fin' => '22:00'],
            ['inicio' => '22:00', 'fin' => '23:00'],
        ];

        // Reservas activas del día para esa cancha
        $reservasDelDia = Reserva::where('cancha_id', $request->cancha_id)
            ->where('fecha_reserva', $request->fecha)
            ->where('estado_reserva', '!=', 'cancelado')
            ->get(['horario_inicio', 'horario_fin']);

        // Marcar cada franja como ocupada o disponible
        $resultado = array_map(function ($franja) use ($reservasDelDia) {
            $ocupada = $reservasDelDia->contains(function ($reserva) use ($franja) {
                // Lógica de solapamiento estricta
                return $reserva->horario_inicio < $franja['fin']
                    && $reserva->horario_fin    > $franja['inicio'];
            });

            return [
                'inicio'  => $franja['inicio'],
                'fin'     => $franja['fin'],
                'label'   => $franja['inicio'] . ' - ' . $franja['fin'],
                'ocupada' => $ocupada,
            ];
        }, $franjas);

        return response()->json($resultado);
    }

    /**
     * Procesa y guarda la reserva pública del cliente.
     */
    public function storeReserva(Request $request)
    {
        $validated = $request->validate([
            'cancha_id'      => 'required|exists:canchas,id',
            'fecha_reserva'  => 'required|date|after_or_equal:today',
            'horario_inicio' => 'required',
            'horario_fin'    => 'required|after:horario_inicio',
            'cliente_nombre' => 'required|string|max:255',
            'precio_total'   => 'required|numeric|min:0',
        ]);

        // Doble verificación de solapamiento en el backend (nunca confiar solo en el frontend)
        $solapamiento = Reserva::where('cancha_id', $validated['cancha_id'])
            ->where('fecha_reserva', $validated['fecha_reserva'])
            ->where('estado_reserva', '!=', 'cancelado')
            ->where(function ($q) use ($validated) {
                $q->where('horario_inicio', '<', $validated['horario_fin'])
                  ->where('horario_fin',    '>', $validated['horario_inicio']);
            })->exists();

        if ($solapamiento) {
            return back()->withErrors([
                'horario_inicio' => 'Lo sentimos, ese horario acaba de ser reservado. Por favor elegí otro.'
            ])->withInput();
        }

        // Valores por defecto para reserva pública
        Reserva::create([
            'cancha_id'      => $validated['cancha_id'],
            'fecha_reserva'  => $validated['fecha_reserva'],
            'horario_inicio' => $validated['horario_inicio'],
            'horario_fin'    => $validated['horario_fin'],
            'cliente_nombre' => $validated['cliente_nombre'],
            'precio_total'   => $validated['precio_total'],
            'monto_senia'    => 0,
            'estado_pago'    => 'pendiente',
            'estado_reserva' => 'reservado',
            'metodo_pago'    => null,
        ]);

        return redirect()->route('landing')->with('success',
            '¡Reserva confirmada, ' . $validated['cliente_nombre'] . '! Te esperamos.'
        );
    }
}