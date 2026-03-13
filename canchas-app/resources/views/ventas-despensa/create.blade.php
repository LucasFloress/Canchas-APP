<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Nueva Venta - Despensa</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-lg mx-auto">
        <div class="bg-white rounded-2xl shadow p-6">

            @if($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg text-sm">
                    @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                </div>
            @endif

            <form action="{{ route('ventas-despensa.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Producto</label>
                    <select name="producto_id" id="producto_id" class="w-full border-gray-300 rounded-lg shadow-sm" required onchange="actualizarPrecio(this)">
                        <option value="">Seleccioná un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}"
                                data-precio="{{ $producto->precio }}"
                                data-stock="{{ $producto->stock }}"
                                {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }} (Stock: {{ $producto->stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', 1) }}" min="1" class="w-full border-gray-300 rounded-lg shadow-sm" required onchange="calcularTotal()">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Estimado</label>
                    <div id="total_estimado" class="w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-gray-700 font-semibold">$0.00</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Método de Pago</label>
                    <select name="metodo_pago" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        <option value="">Seleccioná</option>
                        @foreach(['efectivo' => 'Efectivo', 'transferencia' => 'Transferencia', 'tarjeta' => 'Tarjeta', 'mercadopago' => 'MercadoPago'] as $val => $label)
                            <option value="{{ $val }}" {{ old('metodo_pago') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('ventas-despensa.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Registrar Venta</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function actualizarPrecio(select) {
            calcularTotal();
        }
        function calcularTotal() {
            const select = document.getElementById('producto_id');
            const cantidad = document.getElementById('cantidad').value;
            const precio = select.options[select.selectedIndex]?.dataset.precio || 0;
            const total = (precio * cantidad).toFixed(2);
            document.getElementById('total_estimado').textContent = '$' + total;
        }
    </script>
</x-app-layout>