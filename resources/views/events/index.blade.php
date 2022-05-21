<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Évènements
        </h2>
        @can('create', App\Models\Event::class)
            <x-button :href="route('events.create')">Créer un évènement</x-button>
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($events as $event)
                @can('view', $event)
                    <article class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <header class="mb-3">
                            <h4 class="text-3xl ">{{ $event->title }}</h4>
                        </header>
                        <main>
                            <x-button :href="route('events.show', $event->slug)">
                                Voir
                            </x-button>

                            @can('update', $event)
                                <x-button :href="route('events.edit', $event->id)">
                                    Éditer
                                </x-button>
                            @endcan
                        </main>
                    </article>
                @endcan
            @endforeach
        </div>
    </div>
</x-app-layout>
