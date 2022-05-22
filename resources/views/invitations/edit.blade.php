<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('invitation.title.edit')
        </h1>
    </x-slot>

    <x-form-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('invitations.update', $invitation->id) }}">
            @csrf
            @method('patch')

            <x-form-control name="first_name" :bind="$invitation" />
            <x-form-control name="last_name" :bind="$invitation" />
            <x-form-control name="email" type="email" :bind="$invitation" />
            <x-form-control disabled name="event_id" type="select" :options="$events" :bind="$invitation" />

            <x-button>
                @lang('action.update')
            </x-button>
        </form>
    </x-form-card>
    <x-form-card>
        <h3 class="text-xl mt-1 mb-3">@lang('form.danger_zone')</h3>
        <form method="POST" action="{{ route('invitations.destroy', $invitation->id) }}">
            @csrf
            @method('delete')
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-red-500 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                @lang('action.delete_permanent')
            </button>
        </form>
    </x-form-card>
</x-app-layout>
