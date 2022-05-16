<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invitations
        </h2>
        <div class="flex flex-row gap-2 pt-2">
            <x-button :href="route('invitations.create')">
                Créer une invitation
            </x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($invitations as $invitation)
                <article class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <header class="mb-3">
                        <h4 class="text-3xl ">{{ $invitation->full_name()}}</h4>
                        <h5 class="text-1xl ">{{ $invitation->event->title}}</h5>
                        <h5 class="text-1xl leading-[40px]">@if($invitation->scanned())(scanné par {{ $invitation->scanned_by_user->name }})@endif</h5>
                    </header>
                    <main>
                        <x-button :href="route('invitations.edit', $invitation->id)">
                            Éditer
                        </x-button>

                        <x-button :href="route('invitations.scan', $invitation->key)">
                            Scanner
                        </x-button>

                        <x-button :href="route('invitations.unscan', $invitation->key)">
                            Dé-scanner
                        </x-button>
                    </main>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
