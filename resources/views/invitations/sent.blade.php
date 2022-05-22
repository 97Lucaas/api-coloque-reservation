<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('invitation.title.sent')
        </h1>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-3xl">@lang('invitation.sent')</h3>
                    <p>@lang('invitation.will_receive_at', ['adress'=>$invitation->email]) <b>@lang('invitation.check_spam')</b></p>
                    <p class="pt-2">
                        @lang('invitation.did_not_received') <a class="underline" href="{{ route('invitations.sendmail', $invitation->key) }}">@lang('invitation.send_again')</a>
                    </p>
                </header>
                <main class="p-6">
                    <h4 class="text-2xl">@lang('invitation.resume')</h4>
                    <p>{{ $invitation->full_name() }}</p>
                    <p>{{ $invitation->email }}</p>
                    <p><a class="underline" href="{{ route('events.show', $invitation->event->slug) }}">{{ $invitation->event->title }}</a></p>
                </main>
            </article>
        </div>
    </div>
</x-app-layout>
