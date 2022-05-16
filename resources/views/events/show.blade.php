<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Voir un évènement
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-2xl">{{ $event->title }}</h3>
                    <x-button :href="route('events.edit', $event->id)">Éditer</x-button>
                </header>
                <main class="p-6">
                    <p>{{ $event->description }}</p>
                </main>
                <footer class="p-6">
                    <x-button :href="route('events.invite', $event->slug)">Participer</x-button>
                </footer>
            </article>
        </div>
    </div>
</x-guest-layout>
