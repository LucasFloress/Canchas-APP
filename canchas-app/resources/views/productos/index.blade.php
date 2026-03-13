<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Gestión de Canchas</title>
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="flex min-h-screen">

    {{-- ===================== SIDEBAR ===================== --}}
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
            <a href="/canchas" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:text-white text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                Canchas
            </a>
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2 mt-5">Comercio</p>
            <a href="/productos" class="sidebar-link active flex items-center gap-3 px-3 py-2.5 rounded-lg text-white text-sm font-medium">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
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

    {{-- ===================== MAIN WRAPPER ===================== --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        {{-- TOP HEADER --}}
        <header class="bg-white h-16 shadow-sm border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-20">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Productos</h1>
                <p class="text-xs text-gray-400">Gestión de inventario y precios</p>
            </div>
            <a href="{{ route('productos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nuevo Producto
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

            {{-- Stats rápidas --}}
            @php
                $totalProductos  = $productos->count();
                $stockBajo       = $productos->where('stock', '<=', 5)->where('stock', '>', 0)->count();
                $sinStock        = $productos->where('stock', 0)->count();
                $cantCategorias  = $productos->pluck('categoria')->unique()->count();
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 fade-in">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 cursor-pointer hover:border-blue-200 transition-colors" onclick="limpiarFiltros()">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Productos</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalProductos }}</p>
                    <p class="text-xs text-gray-400 mt-1">mostrando ahora</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Categorías</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $cantCategorias }}</p>
                    <p class="text-xs text-gray-400 mt-1">en este filtro</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 cursor-pointer hover:border-yellow-200 transition-colors" onclick="filtrarPorStock('bajo')">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock Bajo</p>
                    <p class="text-3xl font-extrabold mt-1 {{ $stockBajo > 0 ? 'text-yellow-600' : 'text-gray-800' }}">{{ $stockBajo }}</p>
                    <p class="text-xs text-gray-400 mt-1">≤ 5 unidades</p>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 cursor-pointer hover:border-red-200 transition-colors" onclick="filtrarPorStock('sin_stock')">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Sin Stock</p>
                    <p class="text-3xl font-extrabold mt-1 {{ $sinStock > 0 ? 'text-red-600' : 'text-gray-800' }}">{{ $sinStock }}</p>
                    <p class="text-xs text-gray-400 mt-1">agotados</p>
                </div>
            </div>

            {{-- Barra de filtros --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-4 fade-in-delay-1">
                <form method="GET" action="{{ route('productos.index') }}" id="form-filtros" class="flex flex-wrap items-end gap-4">

                    {{-- Buscador por nombre --}}
                    <div class="flex-1 min-w-48">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Buscar</label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input
                                type="text"
                                name="buscar"
                                value="{{ request('buscar') }}"
                                placeholder="Nombre del producto..."
                                class="w-full pl-9 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            >
                        </div>
                    </div>

                    {{-- Filtro categoría --}}
                    <div class="min-w-44">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Categoría</label>
                        <select name="categoria" id="select-categoria" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" onchange="this.form.submit()">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtro stock --}}
                    <div class="min-w-44">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Estado de Stock</label>
                        <select name="stock" id="select-stock" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" onchange="this.form.submit()">
                            <option value="">Todos</option>
                            <option value="disponible" {{ request('stock') == 'disponible' ? 'selected' : '' }}>✅ Disponible (+5)</option>
                            <option value="bajo"       {{ request('stock') == 'bajo'       ? 'selected' : '' }}>⚠️ Stock bajo (1-5)</option>
                            <option value="sin_stock"  {{ request('stock') == 'sin_stock'  ? 'selected' : '' }}>❌ Sin stock</option>
                        </select>
                    </div>

                    {{-- Botón buscar (para el campo texto) --}}
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Buscar
                    </button>

                    {{-- Limpiar filtros --}}
                    @if(request()->hasAny(['categoria', 'stock', 'buscar']))
                    <a href="{{ route('productos.index') }}" class="bg-white text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Limpiar
                    </a>
                    @endif

                </form>

                {{-- Filtros activos --}}
                @if(request()->hasAny(['categoria', 'stock', 'buscar']))
                <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100 flex-wrap">
                    <span class="text-xs text-gray-500 font-medium">Filtros activos:</span>
                    @if(request('buscar'))
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                            🔍 "{{ request('buscar') }}"
                        </span>
                    @endif
                    @if(request('categoria'))
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                            📦 {{ request('categoria') }}
                        </span>
                    @endif
                    @if(request('stock'))
                        @php $stockLabels = ['disponible' => '✅ Disponible', 'bajo' => '⚠️ Stock bajo', 'sin_stock' => '❌ Sin stock']; @endphp
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1">
                            {{ $stockLabels[request('stock')] }}
                        </span>
                    @endif
                    <span class="text-xs text-gray-400 ml-1">— {{ $totalProductos }} resultado{{ $totalProductos != 1 ? 's' : '' }}</span>
                </div>
                @endif
            </div>

            {{-- Tabla de productos --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden fade-in-delay-2">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Inventario</h2>
                    <span class="text-xs text-gray-400">{{ $totalProductos }} producto{{ $totalProductos != 1 ? 's' : '' }}</span>
                </div>

                @if($productos->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Producto</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Categoría</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Precio</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Stock</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Valor Total</th>
                            <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider py-3 px-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($productos as $producto)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">{{ $producto->nombre }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $producto->categoria }}</span>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-sm font-semibold text-gray-800">${{ number_format($producto->precio, 2, ',', '.') }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                @if($producto->stock == 0)
                                    <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Sin stock</span>
                                @elseif($producto->stock <= 5)
                                    <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $producto->stock }} — Stock bajo</span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">{{ $producto->stock }} unidades</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-600">
                                ${{ number_format($producto->precio * $producto->stock, 2, ',', '.') }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('productos.edit', $producto) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">Editar</a>
                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Eliminar {{ $producto->nombre }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 hover:underline text-sm font-medium">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-500">No hay productos cargados</p>
                    <p class="text-xs text-gray-400 mt-1">Agregá tu primer producto para empezar</p>
                    <a href="{{ route('productos.create') }}" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium text-sm">
                        + Nuevo Producto
                    </a>
                </div>
                @endif
            </div>

        </main>
    </div>
</div>
<script>
    function filtrarPorStock(valor) {
        document.getElementById('select-stock').value = valor;
        document.getElementById('form-filtros').submit();
    }
    function limpiarFiltros() {
        window.location.href = '{{ route("productos.index") }}';
    }
</script>
</body>
</html>