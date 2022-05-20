<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-3xl">
            Voir un évènement
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="flex flex-col gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-2xl">{{ $event->title }}</h3>
                    @can("edit", $event) <x-button :href="route('events.edit', $event->id)">Éditer</x-button> @endcan
                </header>
                <main class="p-6">
                    <p>{{ $event->description }}</p>
                </main>
                <footer class="p-6">
                    <x-button :href="route('events.invite', $event->slug)">
                        Participer
                    </x-button>
                    <x-button :href="route('events.edit', $event->id)">
                            Éditer
                        </x-button>
                        <x-button :href="route('events.show', $event->id)">
                            Scanner
                        </x-button>
                </footer>
            </article>

            @can('exec-commands')
            <article class="bg-white/0 overflow-hidden">
                <header class="">
                    <h3 class="text-2xl">
                        Invitations 
                        @if($event->isLimited()) ({{ $event->invitationsCount() }} / {{ $event->max_invitations}}) @endif
                        {{$event->isFilled() ? 'Rempli' : 'Pas rempli'}}
                    </h3>
                </header>
                <main class="">
                    @foreach($event->invitations as $invitation)
                        <x-invitation-card :invitation="$invitation" />
                    @endforeach
                </main>
            </article>
            @endcan
        </div>
    </div>
</x-guest-layout>
