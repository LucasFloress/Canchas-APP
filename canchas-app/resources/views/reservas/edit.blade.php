<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Editar Reserva</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow p-6">

            @if($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form action="{{ route('reservas.update', $reserva) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cancha</label>
                    <select name="cancha_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        @foreach($canchas as $cancha)
                            <option value="{{ $cancha->id }}" {{ $reserva->cancha_id == $cancha->id ? 'selected' : '' }}>
                                {{ $cancha->numero_o_nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="fecha_reserva" value="{{ $reserva->fecha_reserva->format('Y-m-d') }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <input type="text" name="cliente_nombre" value="{{ $reserva->cliente_nombre }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario Inicio</label>
                        <input type="time" name="horario_inicio" value="{{ substr($reserva->horario_inicio, 0, 5) }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario Fin</label>
                        <input type="time" name="horario_fin" value="{{ substr($reserva->horario_fin, 0, 5) }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio Total</label>
                        <input type="number" name="precio_total" value="{{ $reserva->precio_total }}" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seña</label>
                        <input type="number" name="monto_senia" value="{{ $reserva->monto_senia }}" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Método de Pago</label>
                        <select name="metodo_pago" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">Sin definir</option>
                            @foreach(['efectivo', 'transferencia', 'tarjeta', 'mercadopago'] as $metodo)
                                <option value="{{ $metodo }}" {{ $reserva->metodo_pago == $metodo ? 'selected' : '' }}>{{ ucfirst($metodo) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado de Pago</label>
                        <select name="estado_pago" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            @foreach(['pendiente' => 'Pendiente', 'senia_pagada' => 'Seña Pagada', 'pagado' => 'Pagado'] as $val => $label)
                                <option value="{{ $val }}" {{ $reserva->estado_pago == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado Reserva</label>
                    <select name="estado_reserva" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        @foreach(['disponible', 'reservado', 'cancelado', 'completado'] as $estado)
                            <option value="{{ $estado }}" {{ $reserva->estado_reserva == $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('reservas.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Actualizar Reserva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>