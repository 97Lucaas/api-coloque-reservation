<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('invitation.invitations')
        </h1>
        <div class="flex flex-row gap-2 pt-2">
            <x-button :href="route('invitations.create')">
                @lang('action.create')
            </x-button>
        </div>
    </x-slot>

    <article class="col-span-12 bg-white overflow-auto shadow-sm sm:rounded-lg">
        <header class="p-6">
            @lang('invitation.title.index')
        </header>

        <main class="p-6 pt-0">
            <table class="table-auto w-full text-left">
                <thead>
                    <tr>
                        <th class="pr-8 whitespace-nowrap">@lang('table.last_name')</th>
                        <th class="pr-8 whitespace-nowrap">@lang('table.first_name')</th>
                        <th class="pr-8 whitespace-nowrap">@lang('table.email')</th>
                        <th class="pr-8 whitespace-nowrap">@lang('table.event')</th>
                        <th class="pr-8 whitespace-nowrap">@lang('table.scanned')</th>
                        <th class="pr-8 whitespace-nowrap">@lang('table.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invitations as $invitation)
                        <tr>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->last_name }}</td>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->first_name }}</td>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->email }}</td>
                            <td class="pr-8 whitespace-nowrap">
                                <a class="underline" href="{{ route('events.show', $invitation->event->slug) }}">{{ $invitation->event->title }}</a>
                            </td>
                            <td class="pr-8 whitespace-nowrap">{{ $invitation->scannedHumanized }}</td>
                            <td class="pr-8 whitespace-nowrap">
                                @can('update', $invitation)
                                    <x-button :href="route('invitations.edit', $invitation->id)">@lang('action.edit')</x-button>
                                @endcan
                                @can('scan', $invitation->event)
                                    <x-button :href="route('invitations.scan', $invitation->key)">@lang('action.scan')</x-button>
                                    <x-button :href="route('invitations.unscan', $invitation->key)">@lang('action.unscan')</x-button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main> 
    </article>
</x-app-layout>
