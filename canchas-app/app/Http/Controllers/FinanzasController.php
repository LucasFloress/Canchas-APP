<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\VentaDespensa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanzasController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        // Ingresos de reservas hoy por método de pago
        $reservasHoy = Reserva::whereDate('fecha_reserva', $hoy)
            ->where('estado_pago', '!=', 'pendiente')
            ->selectRaw('metodo_pago, SUM(precio_total) as total, COUNT(*) as cantidad')
            ->groupBy('metodo_pago')
            ->get();

        // Ventas de despensa hoy por método de pago
        $ventasHoy = VentaDespensa::whereDate('created_at', $hoy)
            ->selectRaw('metodo_pago, SUM(total_venta) as total, COUNT(*) as cantidad')
            ->groupBy('metodo_pago')
            ->get();

        // Reservas pendientes de cobro
        $reservasPendientes = Reserva::where('estado_pago', 'pendiente')
            ->where('estado_reserva', 'reservado')
            ->count();

        // Próximas reservas hoy
        $proximasReservas = Reserva::with('cancha')
            ->whereDate('fecha_reserva', $hoy)
            ->where('estado_reserva', 'reservado')
            ->orderBy('horario_inicio')
            ->get();

        $totalReservasHoy = $reservasHoy->sum('total');
        $totalVentasHoy   = $ventasHoy->sum('total');
        $totalDia         = $totalReservasHoy + $totalVentasHoy;

        return view('dashboard', compact(
            'reservasHoy', 'ventasHoy', 'totalReservasHoy',
            'totalVentasHoy', 'totalDia', 'reservasPendientes', 'proximasReservas'
        ));
    }

    public function reporte(Request $request)
    {
        $periodo = $request->get('periodo', 'mensual');
        $origen  = $request->get('origen', 'todos');

        $desde = match($periodo) {
            'diario'  => Carbon::today(),
            'semanal' => Carbon::now()->startOfWeek(),
            'anual'   => Carbon::now()->startOfYear(),
            default   => Carbon::now()->startOfMonth(),
        };

        $hasta = Carbon::now();

        // Ingresos por reservas
        $reservasPorDia = collect();
        $totalReservas  = 0;
        if ($origen !== 'despensa') {
            $reservasPorDia = Reserva::where('fecha_reserva', '>=', $desde)
                ->where('estado_pago', '!=', 'pendiente')
                ->selectRaw('DATE(fecha_reserva) as fecha, SUM(precio_total) as total, metodo_pago')
                ->groupBy('fecha', 'metodo_pago')
                ->orderBy('fecha')
                ->get();
            $totalReservas = $reservasPorDia->sum('total');
        }

        // Ingresos por despensa
        $ventasPorDia = collect();
        $totalVentas  = 0;
        if ($origen !== 'canchas') {
            $ventasPorDia = VentaDespensa::where('created_at', '>=', $desde)
                ->selectRaw('DATE(created_at) as fecha, SUM(total_venta) as total, metodo_pago')
                ->groupBy('fecha', 'metodo_pago')
                ->orderBy('fecha')
                ->get();
            $totalVentas = $ventasPorDia->sum('total');
        }

        // Resumen por método de pago
        $porMetodoCanchas = Reserva::where('fecha_reserva', '>=', $desde)
            ->where('estado_pago', '!=', 'pendiente')
            ->selectRaw('metodo_pago, SUM(precio_total) as total')
            ->groupBy('metodo_pago')
            ->get();

        $porMetodoDespensa = VentaDespensa::where('created_at', '>=', $desde)
            ->selectRaw('metodo_pago, SUM(total_venta) as total')
            ->groupBy('metodo_pago')
            ->get();

        $totalGeneral = $totalReservas + $totalVentas;

        return view('finanzas.reporte', compact(
            'periodo', 'origen', 'desde', 'hasta',
            'totalReservas', 'totalVentas', 'totalGeneral',
            'porMetodoCanchas', 'porMetodoDespensa'
        ));
    }
}