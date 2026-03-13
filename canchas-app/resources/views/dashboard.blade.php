<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestión de Canchas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,0.08); transform: translateX(2px); }
        .sidebar-link.active { background: rgba(59,130,246,0.25); border-left: 3px solid #3b82f6; }
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.4s ease forwards; }
        .fade-in-delay-1 { animation: fadeInUp 0.4s ease 0.05s forwards; opacity: 0; }
        .fade-in-delay-2 { animation: fadeInUp 0.4s ease 0.1s forwards; opacity: 0; }
        .fade-in-delay-3 { animation: fadeInUp 0.4s ease 0.15s forwards; opacity: 0; }
        .fade-in-delay-4 { animation: fadeInUp 0.4s ease 0.2s forwards; opacity: 0; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="flex min-h-screen">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="w-64 bg-slate-800 min-h-screen flex flex-col fixed left-0 top-0 z-30">

        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" fill="none" stroke="white" stroke-width="2"/>
                        <path d="M12 2 L12 22 M2 12 L22 12" stroke="white" stroke-width="1.5"/>
                        <circle cx="12" cy="12" r="3" fill="white"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">Canchas Javi</p>
                    <p class="text-slate-400 text-xs">Panel de Control</p>
                </div>
            </div>
        </div>

        {{-- Navegación --}}
        <nav class="flex-1 px-3 py-4 space-y-1">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2">Principal</p>

            <a href="/dashboard" class="sidebar-link active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-medium">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Inicio
            </a>

            <a href="/reservas" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Reservas
            </a>

            <a href="/canchas" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                Canchas
            </a>

            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2 mt-5">Comercio</p>

            <a href="/productos" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Productos
            </a>

            <a href="/ventas-despensa" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Despensa
            </a>

            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2 mt-5">Reportes</p>

            <a href="/finanzas/reporte" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Finanzas
            </a>
        </nav>

        {{-- Usuario --}}
        <div class="px-4 py-4 border-t border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-slate-400 text-xs truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ===================== MAIN WRAPPER ===================== --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        {{-- ===================== TOP HEADER ===================== --}}
        <header class="bg-white h-16 shadow-sm border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-20">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard</h1>
                <p class="text-xs text-gray-400">{{ \Carbon\Carbon::now()->isoFormat('dddd D [de] MMMM, YYYY') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/reservas/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Nueva Reserva
                </a>
                <a href="/ventas-despensa/create" class="bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Venta Despensa
                </a>
            </div>
        </header>

        {{-- ===================== MAIN CONTENT ===================== --}}
        <main class="flex-1 p-8 space-y-6">

            {{-- Alerta reservas pendientes --}}
            @if(isset($reservasPendientes) && $reservasPendientes > 0)
            <div class="fade-in bg-yellow-50 border border-yellow-200 rounded-xl px-5 py-3.5 flex items-center gap-3">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <p class="text-yellow-800 text-sm font-medium">
                    Tenés <strong>{{ $reservasPendientes }}</strong> reserva{{ $reservasPendientes > 1 ? 's' : '' }} con pago pendiente.
                </p>
                <a href="/reservas" class="ml-auto text-yellow-700 text-sm font-semibold hover:underline">Ver reservas →</a>
            </div>
            @endif

            {{-- ===== TARJETAS DE ESTADÍSTICAS ===== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- Total del día --}}
                <div class="stat-card fade-in bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl p-6 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-blue-200 text-xs font-semibold uppercase tracking-wider">Total del Día</p>
                            <p class="text-4xl font-extrabold mt-2 tracking-tight">${{ number_format($totalDia ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-blue-500 flex items-center gap-2">
                        <span class="text-blue-200 text-xs">Canchas + Despensa combinados</span>
                    </div>
                </div>

                {{-- Canchas --}}
                <div class="stat-card fade-in-delay-1 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Canchas Hoy</p>
                            <p class="text-4xl font-extrabold mt-2 text-gray-800 tracking-tight">${{ number_format($totalReservasHoy ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="text-gray-400 text-xs">{{ $reservasHoy->sum('cantidad') ?? 0 }} reservas cobradas</span>
                    </div>
                </div>

                {{-- Despensa --}}
                <div class="stat-card fade-in-delay-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Despensa Hoy</p>
                            <p class="text-4xl font-extrabold mt-2 text-gray-800 tracking-tight">${{ number_format($totalVentasHoy ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="text-gray-400 text-xs">{{ $ventasHoy->sum('cantidad') ?? 0 }} ventas registradas</span>
                    </div>
                </div>

            </div>

            {{-- ===== FILA INFERIOR: Reservas del día + Métodos de pago ===== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-in-delay-3">

                {{-- Reservas del día (2/3) --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">📅 Reservas de Hoy</h2>
                        <a href="/reservas" class="text-blue-600 text-xs font-medium hover:underline">Ver todas →</a>
                    </div>

                    @if(isset($proximasReservas) && $proximasReservas->count() > 0)
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Horario</th>
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Cliente</th>
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Cancha</th>
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Total</th>
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($proximasReservas as $reserva)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-700">
                                    <span class="font-mono text-gray-500">{{ substr($reserva->horario_inicio, 0, 5) }} - {{ substr($reserva->horario_fin, 0, 5) }}</span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $reserva->cliente_nombre }}</td>
                                <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-600">{{ $reserva->cancha->numero_o_nombre }}</td>
                                <td class="py-3 px-4 whitespace-nowrap text-sm font-semibold text-gray-800">${{ number_format($reserva->precio_total, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    @php
                                        $badge = match($reserva->estado_pago) {
                                            'pagado'       => 'bg-green-100 text-green-700',
                                            'senia_pagada' => 'bg-yellow-100 text-yellow-700',
                                            default        => 'bg-red-100 text-red-700',
                                        };
                                        $label = match($reserva->estado_pago) {
                                            'pagado'       => 'Pagado',
                                            'senia_pagada' => 'Seña',
                                            default        => 'Pendiente',
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge }}">{{ $label }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg class="w-10 h-10 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm">No hay reservas para hoy</p>
                        <a href="/reservas/create" class="mt-3 text-blue-600 text-xs font-medium hover:underline">+ Crear una reserva</a>
                    </div>
                    @endif
                </div>

                {{-- Métodos de pago (1/3) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden fade-in-delay-4">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">💳 Métodos de Pago</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Ingresos del día</p>
                    </div>
                    <div class="p-6 space-y-4">

                        @php
                            $metodos = ['efectivo' => '💵', 'transferencia' => '🏦', 'tarjeta' => '💳', 'mercadopago' => '📱'];
                            $todosPagos = collect();
                            if(isset($reservasHoy)) {
                                foreach($reservasHoy as $r) {
                                    $key = $r->metodo_pago ?? 'sin_definir';
                                    $todosPagos[$key] = ($todosPagos[$key] ?? 0) + $r->total;
                                }
                            }
                            if(isset($ventasHoy)) {
                                foreach($ventasHoy as $v) {
                                    $key = $v->metodo_pago ?? 'sin_definir';
                                    $todosPagos[$key] = ($todosPagos[$key] ?? 0) + $v->total;
                                }
                            }
                            $totalPagos = $todosPagos->sum();
                        @endphp

                        @forelse($todosPagos as $metodo => $monto)
                        @php $porcentaje = $totalPagos > 0 ? round(($monto / $totalPagos) * 100) : 0; @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm">{{ $metodos[$metodo] ?? '💰' }}</span>
                                    <span class="text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $metodo) }}</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-800">${{ number_format($monto, 0, ',', '.') }}</span>
                            </div>
                            <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full transition-all duration-500" style="width: {{ $porcentaje }}%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">{{ $porcentaje }}% del total</p>
                        </div>
                        @empty
                        <div class="text-center py-6 text-gray-400">
                            <p class="text-sm">Sin movimientos hoy</p>
                        </div>
                        @endforelse

                        @if($todosPagos->count() > 0)
                        <div class="pt-3 border-t border-gray-100 flex justify-between">
                            <span class="text-xs text-gray-500 font-medium">Total</span>
                            <span class="text-sm font-bold text-gray-800">${{ number_format($totalPagos, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

</body>
</html>