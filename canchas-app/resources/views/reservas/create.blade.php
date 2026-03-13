<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Nueva Reserva</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow p-6">

            @if($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form action="{{ route('reservas.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cancha</label>
                    <select name="cancha_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Seleccioná una cancha</option>
                        @foreach($canchas as $cancha)
                            <option value="{{ $cancha->id }}" {{ old('cancha_id') == $cancha->id ? 'selected' : '' }}>
                                {{ $cancha->numero_o_nombre }} (Base: ${{ number_format($cancha->precio_base, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="fecha_reserva" value="{{ old('fecha_reserva', date('Y-m-d')) }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <input type="text" name="cliente_nombre" value="{{ old('cliente_nombre') }}" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Nombre del cliente" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario Inicio</label>
                        <input type="time" name="horario_inicio" value="{{ old('horario_inicio') }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horario Fin</label>
                        <input type="time" name="horario_fin" value="{{ old('horario_fin') }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio Total</label>
                        <input type="number" name="precio_total" value="{{ old('precio_total') }}" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seña</label>
                        <input type="number" name="monto_senia" value="{{ old('monto_senia', 0) }}" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="0.00">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Método de Pago</label>
                        <select name="metodo_pago" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="">Sin definir</option>
                            <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            <option value="mercadopago" {{ old('metodo_pago') == 'mercadopago' ? 'selected' : '' }}>MercadoPago</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado de Pago</label>
                        <select name="estado_pago" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="pendiente" {{ old('estado_pago') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="senia_pagada" {{ old('estado_pago') == 'senia_pagada' ? 'selected' : '' }}>Seña Pagada</option>
                            <option value="pagado" {{ old('estado_pago') == 'pagado' ? 'selected' : '' }}>Pagado</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('reservas.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Guardar Reserva</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>