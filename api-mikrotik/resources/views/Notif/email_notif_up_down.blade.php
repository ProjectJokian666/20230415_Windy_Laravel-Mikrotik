@component('mail::message')
# {{ $data['title'] }}

{{$data['message']}}
<br>
{{$data['ip']}}

Framework
{{ config('app.name') }}
@endcomponent