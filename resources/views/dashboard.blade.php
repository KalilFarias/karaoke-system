<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <a href="/pub/meu-karaoke"
               class="bg-purple-600 text-white px-4 py-2 rounded-xl shadow hover:bg-purple-700 transition">
                🎤 Ir para o Karaokê
            </a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-2">
                        Bem-vindo 👋
                    </h3>

                    <p class="text-gray-600 dark:text-gray-300">
                        Você está logado no sistema. Acesse o karaokê para entrar na fila e cantar 🎶
                    </p>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>