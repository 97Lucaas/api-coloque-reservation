<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer une invitation
        </h2>
    </x-slot>
    

    <x-form-card title="Invitation">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('invitations.store') }}">
            @csrf

            <x-form-control label="Prénom" name="first_name" />
            <x-form-control label="Nom" name="last_name" />
            <x-form-control label="Email" name="email" type="email" />
            <x-form-control label="Évenement" name="event_id" type="select" :options="$events" />

            <x-button>
                Générer mon invitation
            </x-button>
        </form>
    </x-form-card>
</x-guest-layout>
