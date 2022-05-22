<x-guest-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('invitation.title.create')
        </h1>
    </x-slot>
    

    <x-form-card :title="__('invitation.title.create')">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('invitations.store') }}">
            @csrf

            <x-form-control name="first_name" />
            <x-form-control name="last_name" />
            <x-form-control name="email" type="email" />
            <x-form-control name="event_id" type="select" :options="$events" />

            <x-button>
                @lang('invitation.send')
            </x-button>
        </form>
    </x-form-card>
</x-guest-layout>
