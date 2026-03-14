<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Reservas</h2>
            <a href="{{ route('reservas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Nueva Reserva</a>
        </div>
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Cancha</th>
                        <th class="px-4 py-3 text-left">Cliente</th>
                        <th class="px-4 py-3 text-left">Fecha</th>
                        <th class="px-4 py-3 text-left">Horario</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Seña</th>
                        <th class="px-4 py-3 text-left">Estado Pago</th>
                        <th class="px-4 py-3 text-left">Estado</th>
                        <th class="px-4 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reservas as $reserva)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $reserva->cancha->numero }}</td>
                        <td class="px-4 py-3">{{ $reserva->cliente_nombre }}</td>
                        <td class="px-4 py-3">{{ $reserva->fecha_reserva->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ substr($reserva->horario_inicio, 0, 5) }} - {{ substr($reserva->horario_fin, 0, 5) }}</td>
                        <td class="px-4 py-3">${{ number_format($reserva->precio_total, 2) }}</td>
                        <td class="px-4 py-3">${{ number_format($reserva->monto_senia, 2) }}</td>
                        <td class="px-4 py-3">
                            @php
                                $colores = ['pendiente' => 'bg-red-100 text-red-700', 'senia_pagada' => 'bg-yellow-100 text-yellow-700', 'pagado' => 'bg-green-100 text-green-700'];
                                $labels  = ['pendiente' => 'Pendiente', 'senia_pagada' => 'Seña Pagada', 'pagado' => 'Pagado'];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $colores[$reserva->estado_pago] }}">
                                {{ $labels[$reserva->estado_pago] }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $coloresEstado = ['reservado' => 'bg-blue-100 text-blue-700', 'cancelado' => 'bg-gray-100 text-gray-500', 'completado' => 'bg-green-100 text-green-700', 'disponible' => 'bg-purple-100 text-purple-700'];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $coloresEstado[$reserva->estado_reserva] }}">
                                {{ ucfirst($reserva->estado_reserva) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('reservas.edit', $reserva) }}" class="text-blue-600 hover:underline text-xs">Editar</a>
                            <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline text-xs">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="px-4 py-8 text-center text-gray-400">No hay reservas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $reservas->links() }}</div>
    </div>
</x-app-layout>