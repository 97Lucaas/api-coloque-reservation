<x-app-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <h1 class="text-3xl mb-3">Évènement {{ $event->title }}</h1>
            <video id="scanner-camera"></video>
            <select id="scanner-camera-choice" class="w-full mt-3"></select>
        </div>
    </div>

    <script>
        window.REDIRECT_AFTER_QR_SCANNED = function(invitation_key) {
            return `{{ route('events.scan', ['event_id'=>$event->id, 'invitation_key'=>'#invitation_key#']) }}`.replace('#invitation_key#', invitation_key);
        };
    </script>
    <script src="{{ asset('js/scanner.js') }}" defer></script>
</x-app-layout>
