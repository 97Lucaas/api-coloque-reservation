@if (session('status') || session('warn') || session('error'))
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="bg-emerald-200 px-6 py-4 rounded-lg text-lg">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-200 px-6 py-4 rounded-lg text-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endif