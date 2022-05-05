<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invitations
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($invitations as $invitation)
                <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <header class="p-6">
                        {{ $invitation->full_name()}}
                        <a href="{{ route('invitations.edit', $invitation->id) }}">Éditer</a>
                    </header>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
