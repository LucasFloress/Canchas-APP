<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detalle de Reserva</h2>
            <a href="{{ route('reservas.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
        </div>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow p-6 space-y-4">

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Cancha:</span> <span class="font-medium">{{ $reserva->cancha->numero_o_nombre }}</span></div>
                <div><span class="text-gray-500">Cliente:</span> <span class="font-medium">{{ $reserva->cliente_nombre }}</span></div>
                <div><span class="text-gray-500">Fecha:</span> <span class="font-medium">{{ $reserva->fecha_reserva->format('d/m/Y') }}</span></div>
                <div><span class="text-gray-500">Horario:</span> <span class="font-medium">{{ substr($reserva->horario_inicio, 0, 5) }} - {{ substr($reserva->horario_fin, 0, 5) }}</span></div>
                <div><span class="text-gray-500">Precio Total:</span> <span class="font-medium">${{ number_format($reserva->precio_total, 2) }}</span></div>
                <div><span class="text-gray-500">Seña:</span> <span class="font-medium">${{ number_format($reserva->monto_senia, 2) }}</span></div>
                <div><span class="text-gray-500">Saldo Restante:</span> <span class="font-bold text-red-600">${{ number_format($reserva->saldo_restante, 2) }}</span></div>
                <div><span class="text-gray-500">Método de Pago:</span> <span class="font-medium">{{ ucfirst($reserva->metodo_pago ?? 'Sin definir') }}</span></div>
                <div><span class="text-gray-500">Estado Pago:</span> <span class="font-medium">{{ ucfirst($reserva->estado_pago) }}</span></div>
                <div><span class="text-gray-500">Estado Reserva:</span> <span class="font-medium">{{ ucfirst($reserva->estado_reserva) }}</span></div>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('reservas.edit', $reserva) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Editar</a>
                <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
                    @csrf @method('DELETE')
                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">Cancelar Reserva</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>