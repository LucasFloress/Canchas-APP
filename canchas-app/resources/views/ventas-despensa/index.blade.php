<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Ventas - Despensa</h2>
            <a href="{{ route('ventas-despensa.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">+ Nueva Venta</a>
        </div>
    </x-slot>

    <div class="py-6 px-4 max-w-5xl mx-auto">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Fecha</th>
                        <th class="px-6 py-3 text-left">Producto</th>
                        <th class="px-6 py-3 text-left">Cantidad</th>
                        <th class="px-6 py-3 text-left">Total</th>
                        <th class="px-6 py-3 text-left">Método Pago</th>
                        <th class="px-6 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ventas as $venta)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-500">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-medium">{{ $venta->producto->nombre }}</td>
                        <td class="px-6 py-4">{{ $venta->cantidad }}</td>
                        <td class="px-6 py-4 font-semibold">${{ number_format($venta->total_venta, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst($venta->metodo_pago) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('ventas-despensa.destroy', $venta) }}" method="POST" onsubmit="return confirm('¿Anular esta venta? Se restaurará el stock.')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline text-xs">Anular</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">No hay ventas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $ventas->links() }}</div>
    </div>
</x-app-layout>