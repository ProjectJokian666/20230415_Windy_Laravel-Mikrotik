@component('mail::message')
# {{ $data['title'] }}

{{$data['message']}}

Framework
{{ config('app.name') }}
@endcomponent