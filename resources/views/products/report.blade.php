<x-app-layout>
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Relatório de Produtos</h1>

        <form method="GET" action="{{ route('products.report.pdf') }}" class="space-y-4">
            <div>
                <x-input-label for="type_id" value="Tipo" />
                <select id="type_id" name="type_id" class="mt-1 block w-full border-gray-300 bg-white text-gray-900 focus:border-gray-500 focus:ring-gray-500 rounded-md shadow-sm">
                    <option value="">Todos</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @selected(request('type_id') == $type->id)>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <x-primary-button>Exportar PDF</x-primary-button>
                <a href="{{ route('products') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>