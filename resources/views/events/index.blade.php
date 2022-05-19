<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Évènements
        </h2>
        <div class="flex flex-row gap-2 pt-2">
            <x-button :href="route('events.create')">
                Créer un évènement
            </x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($events as $event)
                <article class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <header class="mb-3">
                        <h4 class="text-3xl ">{{ $event->title }}</h4>
                    </header>
                    <main>
                        <x-button :href="route('events.show', $event->slug)">
                            Voir
                        </x-button>
                        <x-button :href="route('events.edit', $event->id)">
                            Éditer
                        </x-button>
                        <x-button :href="route('events.show', $event->id)">
                            Scanner
                        </x-button>
                    </main>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
