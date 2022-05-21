<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nous vous avons envoyé un E-Mail !
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <header class="p-6">
                    <h3 class="text-2xl">{{ $invitation->full_name()}}</h3></br>
                    <h4 class="text-xl">{{ $invitation->email }}</h4></br>
                    <h4 class="text-xl">Évènement : {{ $invitation->event->title }}</h4></br>
                </header>
                <main class="p-6">
                    <code>n°{{ $invitation->key }}</code>
                </main>
                <!-- <footer class="p-6">
                    Vous ne l'avez pas reçu ? <x-button :href="route('scanner')">Renvoyez-moi un mail</x-button>
                </footer> -->
            </article>
        </div>
    </div>
</x-app-layout>
