<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier une invitation
        </h2>
    </x-slot>

    <x-form-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('invitations.update', $invitation->id) }}">
            @csrf
            @method('patch')

            <x-form-control label="Prénom" name="first_name" :bind="$invitation" />
            <x-form-control label="Nom" name="last_name" :bind="$invitation" />
            <x-form-control label="Email" name="email" type="email" :bind="$invitation" />
            <x-form-control label="Scanné" name="is_scanned" type="checkbox" :bind="$invitation" />

            <x-button>
                Mettre à jour
            </x-button>
        </form>
    </x-form-card>
</x-app-layout>
