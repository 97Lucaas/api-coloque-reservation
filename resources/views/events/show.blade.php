<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl">
            Voir un évènement
        </h2>
    </x-slot>


    <div class="grid grid-cols-12 items-start gap-4">
        <article class="col-span-12 md:col-span-7 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <header class="p-6">
                <h3 class="text-2xl">{{ $event->title }}</h3>
                <x-button href="#participate" class="md:hidden">Participer</x-button>
                
                @can('scan', $event)
                    <x-button :href="route('events.scanner', $event->id)">Scanner</x-button>
                @endcan

                @can('update', $event)
                    <x-button :href="route('events.edit', $event->id)">Éditer</x-button>
                @endcan

                
            </header>
            <main class="p-6 pt-0">
                @if($event->start_date)<p class="whitespace-pre-line">Début de l'évenement : {{ $event->start_date_humanized }}</p>@endif
                @if($event->place)<p class="whitespace-pre-line">Lieu de l'évenement : {{ $event->place }}</p>@endif

                <p class="whitespace-pre-line">{{ $event->description }}</p>
            </main>
        </article>

        <article id="participate" class="col-span-12 md:col-span-5 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <header class="p-6">
                <h3 class="text-2xl">Participer</h3>
                @if($event->is_public)
                    <p>
                        @if($event->isLimited())
                            {{ $event->remainingInvitationsCount() }} place{{ $event->needS($event->remainingInvitationsCount()) }} restante{{ $event->needS($event->remainingInvitationsCount()) }}
                        @else
                            Places illimitées
                        @endif
                    </p>
                @endif
                @if($event->end_participation_date)<p class="whitespace-pre-line">Fin des inscriptions : {{ $event->end_participation_date_humanized }}</p>@endif
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

                        <small class="block mb-4">En continuant vous acceptez notre <a class="underline" href="{{ route('rgpd') }}">Règlement Général sur la Protection des Données</a></small>

                        <x-button>
                            Recevoir mon invitation
                        </x-button>
                    </form>
                @else
                    @if($event->is_public && ($event->isFull() || $event->is_participation_ended))

                    <div class="rounded-md bg-rose-100 p-4">
                        Vous ne pouvez plus rejoindre cet évènement car :
                        <ul class="list-disc ml-6">

                        @if($event->is_participation_ended)
                            <li>Les inscriptions sont terminées.</li> 
                        @endif
                        
                        @if($event->isFull())
                            <li>L'évenement est plein.</li> 
                        @endif

                        </ul>
                    </div>
  
                    @else
                        <p>Cet évènement est sur invitations seulement.</p>
                    @endif
                @endcan
            </main>
        </article>  

        @can('viewAny', App\Models\Invitation::class)
        <article class="col-span-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <header class="p-6">
                <h3 class="text-2xl">
                    Invitations 
                    @if($event->isLimited())
                        ({{ $event->invitationsCount() }})
                    @endif
                </h3>

                <p>
                    @if($event->isLimited())
                        @choice('event.place.remaining', $event->remainingInvitationsCount())
                        @choice('event.place.on_total', $event->max_invitations)
                    @else
                        Places illimitées
                    @endif
                </p>

                <p>
                    @choice('event.place.scanned.count', $event->scanCount())
                    @choice('event.place.scanned.on_total', $event->invitationsCount())
                </p>
            </header>
            <main class="p-6 pt-0 overflow-auto">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr>
                            <th class="pr-8 whitespace-nowrap">Nom</th>
                            <th class="pr-8 whitespace-nowrap">Prénom</th>
                            <th class="pr-8 whitespace-nowrap">Email</th>
                            <th class="pr-8 whitespace-nowrap">Scanné</th>
                            <th class="pr-8 whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->invitations as $invitation)
                            <tr>
                                <td class="pr-8 whitespace-nowrap">{{ $invitation->last_name }}</td>
                                <td class="pr-8 whitespace-nowrap">{{ $invitation->first_name }}</td>
                                <td class="pr-8 whitespace-nowrap">{{ $invitation->email }}</td>
                                <td class="pr-8 whitespace-nowrap">{{ $invitation->scannedHumanized }}</td>
                                <td class="pr-8 whitespace-nowrap">
                                    @can('update', $invitation)
                                        <x-button :href="route('invitations.edit', $invitation->id)">Éditer</x-button>
                                    @endcan
                                    @can('scan', $event)
                                        <x-button :href="route('invitations.scan', $invitation->key)">
                                            Scanner
                                        </x-button>

                                        <x-button :href="route('invitations.unscan', $invitation->key)">
                                            Dé-scanner
                                        </x-button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </article>
        @endcan
    </div>
</x-app-layout>
