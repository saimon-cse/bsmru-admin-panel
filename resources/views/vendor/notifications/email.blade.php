@component('mail::message')
{{-- Greeting --}}
{{-- <img src="{{ asset('assets/img/bsmru_logo.png') }}" style="height: 100px;" class="logo" alt="Custom Logo"> --}}

@php

$hi = "New";
@endphp

@if (! empty($greeting))
{{-- # {{ $greeting }} --}}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{-- {{ config('app.name') }} --}}
BSMRU ICT Cell
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')

{{-- <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span> --}}
@endslot
@endisset
@endcomponent
