<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cancha - Gestión de Canchas</title>
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
        input:focus { outline: none; }
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
            <div class="flex items-center gap-3">
                <a href="{{ route('canchas.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Editar Cancha</h1>
                    <p class="text-xs text-gray-400">{{ $cancha->numero_o_nombre }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('canchas.destroy', $cancha) }}" method="POST"
                    onsubmit="return confirm('¿Eliminar {{ $cancha->numero_o_nombre }}? Esta acción no se puede deshacer.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 hover:underline text-sm font-medium transition-colors">
                        Eliminar cancha
                    </button>
                </form>
                <a href="{{ route('canchas.index') }}" class="bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium text-sm">
                    Cancelar
                </a>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-8">
            <div class="max-w-2xl mx-auto space-y-6">

                {{-- Errores --}}
                @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-red-700 text-sm font-semibold">Corregí los siguientes errores:</p>
                    </div>
                    @foreach($errors->all() as $error)
                        <p class="text-red-600 text-sm ml-6">• {{ $error }}</p>
                    @endforeach
                </div>
                @endif

                {{-- Preview en vivo --}}
                <div class="bg-gradient-to-br from-slate-700 to-slate-800 rounded-2xl px-6 py-5 fade-in relative overflow-hidden">
                    <div class="absolute right-4 top-4 opacity-10">
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    </div>
                    <div class="relative">
                        <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-2">Vista previa</p>
                        <div class="flex items-center justify-between">
                            <h3 class="text-white text-xl font-bold" id="preview-nombre">{{ $cancha->numero_o_nombre }}</h3>
                            <div class="bg-blue-600 rounded-xl px-3 py-1.5 text-white text-sm font-bold" id="preview-precio">
                                ${{ number_format($cancha->precio_base, 0, ',', '.') }}
                            </div>
                        </div>
                        <p class="text-slate-400 text-xs mt-2">precio base por turno</p>
                    </div>
                </div>

                {{-- Stats de la cancha --}}
                <div class="grid grid-cols-2 gap-4 fade-in-delay-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Reservas Totales</p>
                        <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $cancha->reservas()->count() }}</p>
                        <p class="text-xs text-gray-400 mt-1">históricas</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Reservas Activas</p>
                        <p class="text-3xl font-extrabold text-gray-800 mt-1">
                            {{ $cancha->reservas()->where('estado_reserva', 'reservado')->count() }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">con estado reservado</p>
                    </div>
                </div>

                {{-- Formulario --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden fade-in">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Modificar Datos</h2>
                    </div>

                    <form action="{{ route('canchas.update', $cancha) }}" method="POST" class="p-6 space-y-5">
                        @csrf
                        @method('PUT')

                        {{-- Nombre --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre o Número <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="numero_o_nombre"
                                id="input-nombre"
                                value="{{ old('numero_o_nombre', $cancha->numero_o_nombre) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm @error('numero_o_nombre') border-red-400 @enderror"
                                required
                            >
                            @error('numero_o_nombre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Precio base --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Precio Base por Turno <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
                                <input
                                    type="number"
                                    name="precio_base"
                                    id="input-precio"
                                    value="{{ old('precio_base', $cancha->precio_base) }}"
                                    step="0.01"
                                    min="0"
                                    class="w-full pl-7 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm @error('precio_base') border-red-400 @enderror"
                                    required
                                >
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Este cambio no afecta las reservas ya creadas.</p>
                            @error('precio_base')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Botones --}}
                        <div class="flex justify-end gap-3 pt-2">
                            <a href="{{ route('canchas.index') }}" class="bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium text-sm">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    const inputNombre  = document.getElementById('input-nombre');
    const inputPrecio  = document.getElementById('input-precio');
    const previewNombre = document.getElementById('preview-nombre');
    const previewPrecio = document.getElementById('preview-precio');

    inputNombre.addEventListener('input', () => {
        previewNombre.textContent = inputNombre.value.trim() || 'Sin nombre';
    });

    inputPrecio.addEventListener('input', () => {
        const precio = parseFloat(inputPrecio.value) || 0;
        previewPrecio.textContent = '$' + precio.toLocaleString('es-AR', { minimumFractionDigits: 0 });
    });
</script>
</body>
</html>