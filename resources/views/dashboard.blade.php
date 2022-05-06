<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-2">

            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-3xl mb-3">Invitations</h3>

                    <x-button :href="route('invitations.index')">
                        Tout voir
                    </x-button>
                    
                    <x-button :href="route('invitations.create')">
                        Générer une invitation
                    </x-button>

                    
                </header>
                <main>

                </main>
            </article>
        </div>
    </div>
</x-app-layout>
