<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('invitation.title.show')
        </h1>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h2 class="text-2xl">{{ $invitation->full_name()}} @if($invitation->is_scanned)@lang('invitation.scanned')@endif</h2>
                    <h4 class="text-xl">{{ $invitation->email }}</h4>
                    <h4 class="text-xl">{{ $invitation->event->title }}</h4>
                    <x-button :href="route('invitations.edit', $invitation->id)">@lang('action.edit')</x-button>
                </header>
                <main class="p-6">
                    <code>n°{{ $invitation->key }}</code>
                </main>
                <footer class="p-6">
                    <x-button :href="route('events.scanner', $invitation->event->id)">@lang('action.scan_again')</x-button>
                    @can('globalscan')
                        <x-button :href="route('globalscanner')">@lang('action.scan_again_global')</x-button>
                    @endcan
                </footer>
            </article>
        </div>
    </div>
</x-app-layout>
