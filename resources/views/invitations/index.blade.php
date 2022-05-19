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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($invitations as $invitation)
                <x-invitation-card :invitation="$invitation" />
            @endforeach
        </div>
    </div>
</x-app-layout>
