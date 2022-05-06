<div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
        @if(isset($title))
            <h1 class="text-3xl mt-1 mb-4">{{ $title }}</h1>
        @endif
        {{ $slot }}
    </div>
</div>
