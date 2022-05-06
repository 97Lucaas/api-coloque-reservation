<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invitations
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row">
            @foreach($invitations as $invitation)
                <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-3">
                    <header class="p-6">
                        <h4 class="text-3xl mb-3">{{ $invitation->full_name()}} @if($invitation->is_scanned)(scanné)@endif</h4>

                        <x-button :href="route('invitations.edit', $invitation->id)">
                            Éditer
                        </x-button>

                        <x-button :href="route('invitations.scan', $invitation->key)">
                            Scanner
                        </x-button>
                    </header>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
