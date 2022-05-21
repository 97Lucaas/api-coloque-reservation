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
                        <th class="pr-8 whitespace-nowrap">Nom</th>
                        <th class="pr-8 whitespace-nowrap">Prénom</th>
                        <th class="pr-8 whitespace-nowrap">Email</th>
                        <th class="pr-8 whitespace-nowrap">Évènement</th>
                        <th class="pr-8 whitespace-nowrap">Scanné</th>
                        <th class="pr-8 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invitations as $invitation)
                        <tr>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->last_name }}</td>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->first_name }}</td>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->email }}</td>
                            <td class="pr-8 whitespace-nowrap">
                                <a class="underline" href="{{ route('events.show', $invitation->event->slug) }}">{{ $invitation->event->title }}</a>
                            </td>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->scannedHumanized }}</td>
                            <td class="pr-8 whitespace-nowrap">
                                    @can('update', $invitation)
                                        <x-button :href="route('invitations.edit', $invitation->id)">Éditer</x-button>
                                    @endcan
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main> 
    </article>
</x-app-layout>
