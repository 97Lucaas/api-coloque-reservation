@component('mail::message')

# Hello!

@isset($introLines)
@foreach ($introLines as $line)
{{ $line }}
@endforeach
@endisset

![n° {{ $key }}]({{config('app.url')}}/storage/qrcodes/{{ $key }}.png)

@isset($outroLines)
@foreach ($outroLines as $line)
{{ $line }}
@endforeach
@endisset


Cordialement, <br/>
{{ config('app.name') }}
@endcomponent