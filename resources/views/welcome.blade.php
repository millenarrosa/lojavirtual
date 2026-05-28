<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Trench Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white">

    <header class="bg-[#B2C9B7] shadow p-4 flex flex-col md:flex-row items-center justify-between gap-4 min-h-[100px]">

    <div class="flex-shrink-0">
        <img
            src="{{ asset('images/trenchlogo.png') }}"
            alt="Logo"
            class="w-32 md:w-44 h-auto object-contain transition-all">
    </div>

    <div class="w-full max-w-xl">
        <form action="{{ route('loja.index') }}" method="GET" class="flex gap-2 w-full">

    <input
        type="text"
        name="busca"
        placeholder="Buscar produto..."
        value="{{ request('busca') }}"
        class="border border-gray-300 bg-gray-100 rounded px-4 py-2 text-black text-sm flex-1 focus:outline-none">

    <button
        type="submit"
        class="bg-black text-white px-5 py-2 rounded text-sm font-bold hover:bg-gray-800 transition-colors">
        Buscar
    </button>
</form>
    </div>

    <div class="flex gap-2 flex-shrink-0">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="text-black font-semibold hover:underline text-sm">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-black font-semibold hover:text-gray-700 text-sm">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-black text-white rounded font-bold hover:bg-gray-800 transition-colors text-sm">
                    Cadastre-se
                </a>
            @endauth
        @endif
    </div>

</header>
    <div class="h-10 w-full"></div>
    
    <main class="container mx-auto px-4 pb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($produtos as $produto)
    <div class="bg-gray-100 p-4 rounded-lg shadow hover:shadow-xl transition flex flex-col">
            <div class="w-full aspect-square bg-gray-200 rounded mb-4 overflow-hidden">
        @if($produto->image)
        <img src="{{ asset('storage/' . $produto->image) }}" 
             alt="{{ $produto->name }}" 
             class="w-full h-full object-cover">
        @else
        <div class="w-full aspect-square bg-gray-200 rounded mb-4 overflow-hidden">
            Sem Imagem
        </div>
        @endif
        </div>

                <h3 class="font-bold text-lg text-gray-800">{{ $produto->name }}</h3>
                <p class="text-sm text-gray-500 mb-2 italic line-clamp-2">{{ $produto->description }}</p>

                <div class="mt-auto">
                    <p class="text-green-600 font-bold text-2xl">R$ {{ number_format($produto->price, 2, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Estoque: {{ $produto->quantity }} unidades</p>
                    <button class="mt-4 w-full text-black py-2 rounded font-bold transition hover:opacity-80" style="background-color: #B2C9B7 !important;">
    Comprar
</button>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-xl font-light">Nenhum produto disponível com estoque no momento.</p>
            </div>
            @endforelse
        </div>
    </main>

</body>

</html>