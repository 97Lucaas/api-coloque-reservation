@props(['invitation'])
<article class="mb-6 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <header>
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