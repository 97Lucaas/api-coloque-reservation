<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl">
            Voir un évènement
        </h2>
    </x-slot>


    <div class="grid grid-cols-12 gap-4">
        <article class="col-span-12 md:col-span-7 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <header class="p-6">
                <h3 class="text-2xl">{{ $event->title }}</h3>
                @can("edit", $event) <x-button :href="route('events.edit', $event->id)">Éditer</x-button> @endcan
            </header>
            <main class="p-6">
                <p>{{ $event->description }}</p>
            </main>
            <footer class="p-6">
                @can('edit', $event)
                    <x-button :href="route('events.edit', $event->id)">Éditer</x-button>
                @endcan

                @can('scan')
                <x-button :href="route('events.show', $event->id)">Scanner</x-button>
                @endcan
            </footer>
        </article>

        <article class="col-span-12 md:col-span-5 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <header class="p-6">
                <h3 class="text-2xl">Participer</h3>
                @if($event->is_public)
                    <p>
                        @if($event->isLimited())
                            {{ $event->remainingInvitationsCount() }} place(s) restante(s)
                        @else
                            Places illimitées
                        @endif
                    </p>
                @endif
            </header>
            <main class="p-6 pt-0">
                @can('participate', $event)
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form class="" method="POST" action="{{ route('invitations.store') }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id}}"/>
                        
                        <x-form-control label="Prénom" name="first_name" />
                        <x-form-control label="Nom" name="last_name" />
                        <x-form-control label="Email" name="email" type="email" />
                        <x-button>
                            Recevoir mon invitation
                        </x-button>
                    </form>
                @else
                    @if($event->is_public && $event->isFull())
                        <p>Vous ne pouvez plus rejoindre cet évènement.</p>    
                    @else
                        <p>Cet évènement est sur invitations seulement</p>
                    @endif
                @endcan
            </main>
        </article>  

        @can('exec-commands')
        <article class="bg-white/0 overflow-hidden">
            <header class="">
                <h3 class="text-2xl">
                    Invitations 
                    @if($event->isLimited()) ({{ $event->invitationsCount() }} / {{ $event->max_invitations}}) @endif
                    {{$event->isFull() ? 'Rempli' : 'Pas rempli'}}
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
</x-app-layout>
