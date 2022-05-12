<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">

            <article class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="mb-3">
                    <h3 class="text-3xl">Invitations</h3>
                </header>
                <main class="flex flex-row flex-wrap gap-3">

                    <x-button :href="route('invitations.index')">
                        Tout voir
                    </x-button>
                    
                    <x-button :href="route('invitations.create')">
                        Générer une invitation
                    </x-button>

                </main>
            </article>


            @can('exec-commands')
            <article class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="mb-3">
                    <h3 class="text-3xl">Panel admin</h3>
                </header>
                <main class="flex flex-row flex-wrap gap-3">
                    <x-button :href="route('command.gitpull')">
                        Git Pull
                    </x-button>

                    <x-button :href="route('command.migrate')">
                        Artisan Migrate
                    </x-button>
                </main>
            </article>
            @endcan
        </div>
    </div>
</x-app-layout>
