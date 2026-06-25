<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Card valor total --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-500 uppercase tracking-wider mb-1">Valor Total do Estoque</p>
                <p class="text-4xl font-bold text-green-600">R$ {{ number_format($totalEstoque, 2, ',', '.') }}</p>
            </div>

            {{-- Cards por tipo --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($totalPorTipo as $tipo)
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex flex-col gap-2">
                <p class="text-sm text-gray-500 uppercase tracking-wider">{{ $tipo['nome'] }}</p>
                <p class="text-2xl font-bold text-gray-800">{{ $tipo['quantidade'] }} produtos</p>
                <p class="text-green-600 font-semibold">R$ {{ number_format($tipo['valor'], 2, ',', '.') }}</p>
                <a href="{{ route('products.report.pdf', ['type_id' => $tipo['id']]) }}" style="background-color: #000000ff;" class="text-white text-center text-sm px-3 py-1 rounded hover:opacity-80 mt-2">Gerar Relatório</a>
            </div>
            @endforeach
            </div>

            {{-- Gráfico --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-500 uppercase tracking-wider mb-4">Valor por Tipo</p>
                <canvas id="graficoTipos" height="100"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($totalPorTipo->pluck('nome'));
        const valores = @json($totalPorTipo->pluck('valor'));

        new Chart(document.getElementById('graficoTipos'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Valor em estoque (R$)',
                    data: valores,
                    backgroundColor: '#B2C9B7',
                    borderColor: '#4f7a5c',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => 'R$ ' + ctx.raw.toLocaleString('pt-BR', {minimumFractionDigits: 2})
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (val) => 'R$ ' + val.toLocaleString('pt-BR')
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>