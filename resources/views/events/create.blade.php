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

            <x-form-control x-on:keyup="$refs.slug.value = $refs.title.value.slugify()" name="title" />
            <x-form-control name="slug" />
            <x-form-control name="description" type="textarea" />

            <x-form-control name="place" />

            <x-form-control name="end_participation_date" type="dateTime-local" />
            <x-form-control name="start_date" type="dateTime-local" />

            <x-form-control name="is_public" type="checkbox" value="true"/>
            <div x-on:click="max_invitations_enabled=$refs.max_invitations_enabled.checked">
                <x-form-control name="max_invitations_enabled" type="checkbox"  />
            </div>
            <div x-show="max_invitations_enabled">
                <x-form-control name="max_invitations" type="number" />
            </div>

            <x-button>
                Créer l'évènement
            </x-button>
        </form>
    </x-form-card>
</x-app-layout>
