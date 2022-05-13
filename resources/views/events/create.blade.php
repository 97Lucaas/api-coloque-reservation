<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un évènement
        </h2>
    </x-slot>
    

    <x-form-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('events.store') }}">
            @csrf

            <x-form-control label="Titre" name="title" />
            <x-form-control label="Description" name="description" />
            <x-form-control label="Évènement public" name="is_public" type="checkbox" />
            <x-form-control label="Nombre d'invités maximum" name="max_invitations_enabled" type="checkbox" />
            <x-form-control label="Nombre d'invités maximum" name="max_invitations" type="number" />

            <x-button>
                Créer l'évènement
            </x-button>
        </form>
    </x-form-card>
</x-app-layout>
