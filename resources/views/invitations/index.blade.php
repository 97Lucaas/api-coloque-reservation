<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invitations
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($invitations as $invitation)
                <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <header class="p-6">
                        <div class="flex flex-row"><h4 class="text-3xl mb-3 mr-4">{{ $invitation->full_name()}}</h4><span class="text-1xl mb-3 leading-[40px]">@if($invitation->is_scanned)(scanné)@endif</span></div>

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
