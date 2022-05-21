<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invitations
        </h2>
        <div class="flex flex-row gap-2 pt-2">
            <x-button :href="route('invitations.create')">
                Créer une invitation
            </x-button>
        </div>
    </x-slot>

    <article class="col-span-12 bg-white overflow-auto shadow-sm sm:rounded-lg">
        <header class="p-6">
            Toutes les invitations
        </header>

        <main class="p-6 pt-0">
            <table class="table-auto w-full text-left">
                <thead>
                    <tr>
                        <th class="pr-8">Nom</th>
                        <th class="pr-8">Prénom</th>
                        <th class="pr-8">Email</th>
                        <th class="pr-8">Évènement</th>
                        <th class="pr-8">Scanné</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invitations as $invitation)
                        <tr>
                            <td class="pr-8">{{ $invitation->last_name }}</td>
                            <td class="pr-8">{{ $invitation->first_name }}</td>
                            <td class="pr-8">{{ $invitation->email }}</td>
                            <td class="pr-8">
                                <a class="underline" href="{{ route('events.show', $invitation->event->slug) }}">{{ $invitation->event->title }}</a>
                            </td>
                            <td class="pr-8">{{ $invitation->scanned() ? "Par ".$invitation->scanned_by_user->name : 'Non' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main> 
    </article>
</x-app-layout>
