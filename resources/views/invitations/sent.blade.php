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
                    <h3 class="text-3xl">Invitation envoyée !</h3>
                    <p>Vous allez la recevoir à l'adresse {{ $invitation->email }}</p>
                    <p class="pt-2">
                        Vous ne l'avez pas reçu ? <a class="underline" href="{{ route('invitations.sendmail', $invitation->key) }}">Renvoyer l'invitation</a>
                    </p>
                </header>
                <main class="p-6">
                    <h4 class="text-2xl">Résumé de l'invitation</h4>
                    <p>{{ $invitation->full_name() }}</p>
                    <p>{{ $invitation->email }}</p>
                    <p>Évènement : {{ $invitation->event->title }}</p>
                </main>
                <!-- <footer class="p-6">
                    Vous ne l'avez pas reçu ? <x-button :href="route('scanner')">Renvoyez-moi un mail</x-button>
                </footer> -->
            </article>
        </div>
    </div>
</x-app-layout>
