<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <h1 class="text-3xl mt-1 mb-4">Gestion invitations colloque</h1>
            
            <x-button :href="route('invitations.create')">
                Générer une invitation
            </x-button>

            <x-button :href="route('dashboard')">
                Accéder au panel
            </x-button>

            
        </div>
    </div>
</x-guest-layout>
