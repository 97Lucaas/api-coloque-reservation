<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    You're logged in!
                </header>
            </article>

            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-2xl">Invitations</h3>
                    <a href="{{ route('invitations.index') }}">Liste</a>
                    <a href="{{ route('invitations.create') }}">Créer</a>
                </header>
                <main>

                </main>
            </article>
        </div>
    </div>
</x-app-layout>
