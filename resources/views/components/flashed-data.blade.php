<div id="notifications-container" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-3 py-6">
    @if (session('status'))
        <x-flashed.status/>
    @endif

    @if (session('error'))
        <x-flashed.error/>
    @endif
</div>