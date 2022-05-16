<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer une invitation
        </h2>
    </x-slot>
    

    <x-form-card title="Participer à {{ $event->title }}">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('invitations.store') }}">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id}}"/>
            <x-form-control label="Prénom" name="first_name" />
            <x-form-control label="Nom" name="last_name" />
            <x-form-control label="Email" name="email" type="email" />
            <x-button>
                Générer mon invitation
            </x-button>
        </form>
    </x-form-card>
</x-guest-layout>
