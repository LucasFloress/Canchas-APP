<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Reportes de Finanzas</h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:underline">← Volver al Dashboard</a>
        </div>
    </x-slot>

    <div class="py-6 px-4 max-w-5xl mx-auto space-y-6">

        {{-- Filtros --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <form action="{{ route('finanzas.reporte') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Período</label>
                    <select name="periodo" class="border-gray-300 rounded-lg shadow-sm text-sm">
                        @foreach(['diario' => 'Hoy', 'semanal' => 'Esta Semana', 'mensual' => 'Este Mes', 'anual' => 'Este Año'] as $val => $label)
                            <option value="{{ $val }}" {{ $periodo == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Origen</label>
                    <select name="origen" class="border-gray-300 rounded-lg shadow-sm text-sm">
                        @foreach(['todos' => 'Todos', 'canchas' => 'Solo Canchas', 'despensa' => 'Solo Despensa'] as $val => $label)
                            <option value="{{ $val }}" {{ $origen == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm transition">Filtrar</button>
            </form>
        </div>

        {{-- Totales --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-500 text-white rounded-2xl p-6 shadow">
                <p class="text-sm uppercase opacity-80">Total General</p>
                <p class="text-3xl font-bold mt-1">${{ number_format($totalGeneral, 2) }}</p>
            </div>
            <div class="bg-blue-500 text-white rounded-2xl p-6 shadow">
                <p class="text-sm uppercase opacity-80">Canchas</p>
                <p class="text-3xl font-bold mt-1">${{ number_format($totalReservas, 2) }}</p>
            </div>
            <div class="bg-yellow-500 text-white rounded-2xl p-6 shadow">
                <p class="text-sm uppercase opacity-80">Despensa</p>
                <p class="text-3xl font-bold mt-1">${{ number_format($totalVentas, 2) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Canchas por método --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">⚽ Canchas por Método de Pago</h3>
                @forelse($porMetodoCanchas as $item)
                    <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                        <span class="capitalize text-gray-600">{{ $item->metodo_pago ?? 'Sin definir' }}</span>
                        <span class="font-semibold">${{ number_format($item->total, 2) }}</span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Sin datos.</p>
                @endforelse
            </div>

            {{-- Despensa por método --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-semibold text-gray-700 mb-4">🛒 Despensa por Método de Pago</h3>
                @forelse($porMetodoDespensa as $item)
                    <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                        <span class="capitalize text-gray-600">{{ $item->metodo_pago }}</span>
                        <span class="font-semibold">${{ number_format($item->total, 2) }}</span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Sin datos.</p>
                @endforelse
            </div>

        </div>

        <p class="text-xs text-gray-400 text-center">Período: {{ $desde->format('d/m/Y') }} — {{ $hasta->format('d/m/Y H:i') }}</p>

    </div>
</x-app-layout>