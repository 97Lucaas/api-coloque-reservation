<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un évènement
        </h2>
    </x-slot>
    

    <x-form-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('events.store') }}" x-data="{max_invitations_enabled:false}">
            @csrf

            <x-form-control x-on:keyup="$refs.slug.value = $refs.title.value.slugify()" label="Titre" name="title" />
            <x-form-control label="Slug (url)" name="slug" />
            <x-form-control label="Description" name="description" />
            <x-form-control label="Évènement public" name="is_public" type="checkbox" />
            <div x-on:click="max_invitations_enabled=$refs.max_invitations_enabled.checked">
                <x-form-control label="Limite d'invités" name="max_invitations_enabled" type="checkbox"  />
            </div>
            <div x-show="max_invitations_enabled">
                <x-form-control label="Nombre d'invités maximum" name="max_invitations" type="number" />
            </div>

            <x-button>
                Créer l'évènement
            </x-button>
        </form>
    </x-form-card>
</x-app-layout>
