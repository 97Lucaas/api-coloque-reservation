<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un utilisateur
        </h2>
    </x-slot>

    <x-form-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('patch')

            <x-form-control label="Nom" name="name" :bind="$user" />
            <x-form-control label="Email" name="email" type="email" :bind="$user" />
            @can('changeRole', $user)
                <x-form-control label="Rôle" name="role" type="select" :options="$user->roles" :bind="$user" />
            @endcan

            <x-button>
                Mettre à jour
            </x-button>
        </form>
    </x-form-card>
    @can('delete', $user)
    <x-form-card>
        <h3 class="text-xl mt-1 mb-3">Zone dangereuse</h3>
        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
            @csrf
            @method('delete')
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-red-500 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Supprimer (irréversible)
            </button>
        </form>
    </x-form-card>
    @endcan
</x-app-layout>
