<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Voir une invitation
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-2xl">{{ $invitation->full_name()}} @if($invitation->is_scanned)(scanné)@endif</h3>
                    <h4 class="text-xl">{{ $invitation->email}}</h4>
                    <a href="{{ route('invitations.edit', $invitation->id) }}">Éditer</a>
                </header>
                <main class="p-6">
                    <code>n°{{ $invitation->key }}</code>
                </main>
                <x-button :href="route('scanner')">Scanner à nouveau</x-button>
            </article>
        </div>
    </div>
</x-app-layout>
