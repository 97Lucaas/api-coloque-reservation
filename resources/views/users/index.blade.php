<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Utilisateurs
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($users as $user)
                <article class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <header class="mb-3">
                        <h4 class="text-3xl ">{{ $user->name}}</h4>
                    </header>
                    <main>
                        <x-button :href="route('users.edit', $user->id)">
                            Éditer
                        </x-button>
                    </main>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
