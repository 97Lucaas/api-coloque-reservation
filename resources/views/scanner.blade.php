<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Scanner
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <h3 class="text-3xl mt-1 mb-3">Scanner une invitation</h3>


                <video id="scanner-camera"></video>


        </div>
    </div>

    <script src="{{ asset('js/scanner.js') }}" defer></script>
</x-app-layout>
