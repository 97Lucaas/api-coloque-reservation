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
                
                @can('update', $event)
                    <x-button :href="route('events.edit', $event->id)">Éditer</x-button>
                @endcan

                @can('scan')
                <x-button :href="route('events.show', $event->id)">Scanner</x-button>
                @endcan
            </header>
            <main class="p-6 pt-0">
                <p>{{ $event->description }}</p>
            </main>
        </article>

        <article class="col-span-12 md:col-span-5 bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                    @if($event->is_public && $event->isFull())
                        <p>Vous ne pouvez plus rejoindre cet évènement.</p>    
                    @else
                        <p>Cet évènement est sur invitations seulement</p>
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
                        {{ $event->remainingInvitationsCount() }} place{{ $event->needS($event->remainingInvitationsCount()) }} restante{{ $event->needS($event->remainingInvitationsCount()) }} sur {{ $event->max_invitations }} place{{ $event->needS($event->max_invitations) }}
                    @else
                        Places illimitées
                    @endif
                </p>
            </header>
            <main class="p-6 pt-0 overflow-auto">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr>
                            <th class="pr-8">Nom</th>
                            <th class="pr-8">Prénom</th>
                            <th class="pr-8">Email</th>
                            <th class="pr-8">Scanné</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->invitations as $invitation)
                            <tr>
                                <td class="pr-8">{{ $invitation->last_name }}</td>
                                <td class="pr-8">{{ $invitation->first_name }}</td>
                                <td class="pr-8">{{ $invitation->email }}</td>
                                <td class="pr-8">{{ $invitation->scanned() ? "Par ".$invitation->scanned_by_user->name : 'Non' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </article>
        @endcan
    </div>
</x-app-layout>
