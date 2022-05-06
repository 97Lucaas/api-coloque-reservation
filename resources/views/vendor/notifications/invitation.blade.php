@component('mail::message')
    {{-- Greeting --}}
    @if (! empty($greeting))
        # {{ $greeting }}
    @else
        @if (isset($level) && $level === 'error')
            # @lang('Whoops!')
        @else
            # @lang('Hello!')
        @endif
    @endif

    @isset($introLines)
        {{-- Intro Lines --}}
        @foreach ($introLines as $line)
        {{ $line }}
        @endforeach
    @endisset

    @component('mail::qrcode', ["key"=>$key])

    @endcomponent


    @isset($outroLines)
        {{-- Outro Lines --}}
        @foreach ($outroLines as $line)
            {{ $line }}
        @endforeach
    @endisset


    {{-- Salutation --}}
    @if (! empty($salutation))
        {{ $salutation }}
    @else
        Cordialement, {{ config('app.name') }}
    @endif

    {{-- Subcopy --}}
    @isset($actionText)
        @slot('subcopy')
            @lang(
                "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
                'into your web browser:',
                [
                    'actionText' => $actionText,
                ]
            ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        @endslot
    @endisset
@endcomponent
