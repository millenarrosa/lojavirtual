<x-app-layout>
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Meus Pedidos</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse($orders as $order)
            <div class="border border-gray-200 rounded-lg mb-4 p-4">
                <div class="flex justify-between items-center mb-3">
                    <span class="font-semibold text-gray-700">Pedido #{{ $order->id }}</span>
                    <span class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</span>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-bold
                        {{ $order->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->status === 'concluido' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $order->status === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left px-3 py-2 text-gray-600">Produto</th>
                            <th class="text-left px-3 py-2 text-gray-600">Quantidade</th>
                            <th class="text-left px-3 py-2 text-gray-600">Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-t border-gray-100">
                                <td class="px-3 py-2 text-gray-800">{{ $item->product->name }}</td>
                                <td class="px-3 py-2 text-gray-800">{{ $item->quantity }}</td>
                                <td class="px-3 py-2 text-gray-800">R$ {{ number_format($item->price, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-3 font-bold text-gray-900">
                    Total: R$ {{ number_format($order->total, 2, ',', '.') }}
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-10">Você ainda não fez nenhum pedido.</p>
        @endforelse
    </div>
</x-app-layout>
