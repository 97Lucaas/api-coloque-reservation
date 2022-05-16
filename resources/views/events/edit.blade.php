<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un évènement
        </h2>
    </x-slot>
    

    <x-form-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('events.update', $event->id) }}">
            @csrf
            @method('patch')

            <x-form-control label="Titre" name="title" :bind="$event" />
            <x-form-control label="Description" name="description" :bind="$event" />
            <x-form-control label="Évènement public" name="is_public" type="checkbox" :bind="$event" />
            <x-form-control label="Nombre d'invités maximum" name="max_invitations_enabled" type="checkbox" :bind="$event" />
            <x-form-control label="Nombre d'invités maximum" name="max_invitations" type="number" :bind="$event" />
            <x-form-control label="Slug" name="slug" :bind="$event" />

            <x-button>
                Mettre à jour
            </x-button>
        </form>
    </x-form-card>


    <x-form-card>
        <h3 class="text-xl mt-1 mb-3">Zone dangereuse</h3>
        <form method="POST" action="{{ route('events.destroy', $event->id) }}">
            @csrf
            @method('delete')
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-red-500 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Supprimer (irréversible)
            </button>
        </form>
    </x-form-card>
</x-app-layout>
