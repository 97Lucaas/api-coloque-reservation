<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <h1 class="text-3xl mt-1 mb-4">Évènements</h1>
            
            <x-button :href="route('events.index')">
                Voir les évènements
            </x-button>

            <x-button :href="route('dashboard')">
                Panel de gestion
            </x-button>

            
        </div>
    </div>
</x-app-layout>
