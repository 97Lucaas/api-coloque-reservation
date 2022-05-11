@component('mail::message')

# Bonjour !

@isset($introLines)
@foreach ($introLines as $line)
{{ $line }}
@endforeach
@endisset

![n° {{ $key }}]({{config('app.url')}}/invitations/{{ $key }}/qrcode)

@isset($outroLines)
@foreach ($outroLines as $line)
{{ $line }}
@endforeach
@endisset


Cordialement, <br/>
{{ config('app.name') }}
@endcomponent