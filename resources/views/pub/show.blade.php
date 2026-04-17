<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pub->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-gray-200">

    <div class="max-w-4xl mx-auto p-6">

        <div class="flex justify-between items-center mb-10 border-b border-gray-800 pb-4">
            <h1 class="text-3xl font-bold tracking-wide text-white">
                {{ $pub->name }}
            </h1>

            <a href="{{ route('dashboard') }}"
                class="border border-white text-white px-4 py-2 rounded-xl hover:bg-white hover:text-black transition">
                Usuário
            </a>
        </div>

        \\formulario pra inserir musica
        @auth
            <div class="bg-gray-900 p-6 rounded-2xl shadow-lg mb-6 border border-gray-800">
                <h3 class="text-xl font-semibold mb-4 text-white">Adicionar música</h3>

                <form method="POST" action="{{ route('songs.store') }}" class="grid gap-3">
                    @csrf

                    <input type="hidden" name="pub_id" value="{{ $pub->id }}">

                    <input type="text" name="song_name" placeholder="Nome da música"
                        class="bg-black border border-gray-700 p-2 rounded-lg text-white focus:outline-none focus:border-white"
                        required>

                    <input type="text" name="artist_name" placeholder="Artista"
                        class="bg-black border border-gray-700 p-2 rounded-lg text-white focus:outline-none focus:border-white"
                        required>

                    <button type="submit"
                        class="bg-white text-black py-2 rounded-xl hover:bg-gray-200 transition font-semibold">
                        Entrar na fila
                    </button>
                </form>
            </div>
        @endauth

        \\mensagens
        @if(session('success'))
            <div class="bg-green-900 text-green-300 p-3 rounded-xl mb-4 border border-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-900 text-red-300 p-3 rounded-xl mb-4 border border-red-800">
                {{ session('error') }}
            </div>
        @endif

        @guest
            <div class="bg-gray-900 p-6 rounded-2xl shadow mb-6 text-center border border-gray-800">
                <p class="mb-4 text-gray-400">Para entrar na fila, faça login ou crie uma conta </p>

                <div class="flex gap-3 justify-center">
                    <a href="{{ route('login') }}"
                        class="border border-white text-white px-4 py-2 rounded-xl hover:bg-white hover:text-black transition">
                        Já tenho conta
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-xl hover:bg-gray-700 transition">
                        Criar conta
                    </a>
                </div>
            </div>
        @endguest

        \\aqui mostra a fila
        <h2 class="text-2xl font-bold mb-4 text-white border-b border-gray-800 pb-2">
            Fila atual
        </h2>

        @if($queue->isEmpty())
            <div class="bg-gray-900 p-6 rounded-2xl shadow text-center border border-gray-800">
                <p class="text-gray-500">Ninguém na fila ainda </p>
            </div>
        @endif

        <div class="space-y-4">
            @foreach($queue as $song)
                <div
                    class="bg-gray-900 p-4 rounded-2xl shadow flex justify-between items-center border border-gray-800 hover:border-white transition">

                    <div>
                        <p class="font-bold text-lg text-white">
                            #{{ $song->position }} - {{ $song->user->name }} 🎤
                        </p>
                        <p class="text-gray-400">
                            {{ $song->song_name }} - {{ $song->artist_name }}
                        </p>
                    </div>

                    @auth
                        @if (auth()->user()->is_admin)
                            <form method="POST" action="{{ route('songs.finish', $song->id) }}">
                                @csrf
                                <button class="bg-red-700 text-white px-3 py-2 rounded-xl hover:bg-red-600 transition">
                                    Finalizar ✅
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>
            @endforeach
        </div>

    </div>

</body>

</html>