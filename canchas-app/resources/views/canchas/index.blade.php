<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canchas - Gestión de Canchas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,0.08); transform: translateX(2px); }
        .sidebar-link.active { background: rgba(59,130,246,0.25); border-left: 3px solid #3b82f6; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.35s ease forwards; }
        .fade-in-delay-1 { animation: fadeInUp 0.35s ease 0.05s forwards; opacity: 0; }
        .fade-in-delay-2 { animation: fadeInUp 0.35s ease 0.1s forwards; opacity: 0; }
        .cancha-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .cancha-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-slate-800 min-h-screen flex flex-col fixed left-0 top-0 z-30">
        <div class="px-6 py-5 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2"/>
                        <path d="M12 3 L12 21 M3 12 L21 12" stroke="white" stroke-width="1.5"/>
                        <circle cx="12" cy="12" r="3" fill="white"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">Canchas Javi</p>
                    <p class="text-slate-400 text-xs">Panel de Control</p>
                </div>
            </div>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2">Principal</p>
            <a href="/dashboard" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Inicio
            </a>
            <a href="/reservas" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Reservas
            </a>
            <a href="/canchas" class="sidebar-link active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-medium">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
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

    {{-- MAIN WRAPPER --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        {{-- TOP HEADER --}}
        <header class="bg-white h-16 shadow-sm border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-20">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Canchas</h1>
                <p class="text-xs text-gray-400">Gestión de canchas y precios base</p>
            </div>
            <a href="{{ route('canchas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nueva Cancha
            </a>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-8 space-y-6">

            {{-- Alertas --}}
            @if(session('success'))
            <div class="fade-in bg-green-50 border border-green-200 rounded-xl px-5 py-3.5 flex items-center gap-3">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-green-800 text-sm font-medium">{{ session('success') }}</p>
            </div>
            @endif
            @if(session('error'))
            <div class="fade-in bg-red-50 border border-red-200 rounded-xl px-5 py-3.5 flex items-center gap-3">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-red-800 text-sm font-medium">{{ session('error') }}</p>
            </div>
            @endif

            {{-- Stats --}}
            @php
                $totalCanchas    = $canchas->count();
                $totalReservas   = $canchas->sum('reservas_count');
                $precioPromedio  = $totalCanchas > 0 ? $canchas->avg('precio_base') : 0;
                $precioMaximo    = $canchas->max('precio_base') ?? 0;
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 fade-in">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Canchas</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalCanchas }}</p>
                    <p class="text-xs text-gray-400 mt-1">registradas</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Reservas</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalReservas }}</p>
                    <p class="text-xs text-gray-400 mt-1">históricas</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Precio Promedio</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">${{ number_format($precioPromedio, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">por turno</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Precio Más Alto</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">${{ number_format($precioMaximo, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">base</p>
                </div>
            </div>

            {{-- Cards de canchas --}}
            @if($canchas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 fade-in-delay-1">
                @foreach($canchas as $cancha)
                <div class="cancha-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- Header de la card con gradiente --}}
                    <div class="bg-gradient-to-br from-slate-700 to-slate-800 px-6 py-5 relative overflow-hidden">
                        {{-- Decoración fondo --}}
                        <div class="absolute right-4 top-4 opacity-10">
                            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                            </svg>
                        </div>
                        <div class="relative">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Cancha</p>
                                    <h3 class="text-white text-xl font-bold tracking-tight">{{ $cancha->numero }}</h3>
                                </div>
                                <div class="bg-blue-600 rounded-xl px-3 py-1.5 text-white text-sm font-bold">
                                    ${{ number_format($cancha->precio_base, 0, ',', '.') }}
                                </div>
                            </div>
                            <p class="text-slate-400 text-xs mt-3">precio base por turno</p>
                        </div>
                    </div>

                    {{-- Body de la card --}}
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs text-gray-500 font-medium">Reservas totales</span>
                            <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                {{ $cancha->reservas_count }} reservas
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-xs text-gray-500 font-medium">Precio base</span>
                            <span class="text-sm font-bold text-gray-800">${{ number_format($cancha->precio_base, 2, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Footer acciones --}}
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{ route('canchas.edit', $cancha) }}" class="bg-blue-600 text-white px-4 py-1.5 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Editar
                        </a>
                        <form action="{{ route('canchas.destroy', $cancha) }}" method="POST" onsubmit="return confirm('¿Eliminar {{ $cancha->numero_o_nombre }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline text-sm font-medium transition-colors">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach

                {{-- Card para agregar nueva cancha --}}
                <a href="{{ route('canchas.create') }}" class="cancha-card border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center py-12 text-gray-400 hover:border-blue-300 hover:text-blue-500 transition-colors group">
                    <div class="w-12 h-12 rounded-2xl bg-gray-100 group-hover:bg-blue-50 flex items-center justify-center mb-3 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <p class="text-sm font-semibold">Agregar cancha</p>
                    <p class="text-xs mt-1 opacity-70">Nueva cancha al complejo</p>
                </a>
            </div>
            @else
            {{-- Estado vacío --}}
            <div class="fade-in bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-20">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                </div>
                <p class="text-sm font-semibold text-gray-500">No hay canchas registradas</p>
                <p class="text-xs text-gray-400 mt-1">Agregá tu primera cancha para empezar</p>
                <a href="{{ route('canchas.create') }}" class="mt-5 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm">
                    + Nueva Cancha
                </a>
            </div>
            @endif

        </main>
    </div>
</div>
</body>
</html>