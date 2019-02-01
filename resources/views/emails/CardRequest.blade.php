@component('mail::message')
Title : ID Card Request.

{{-- Dear {{$name}} --}}
Dear Team,

 A new staff ID Card request has been sent for your attention. Click button to Approve.

@component('mail::button', ['url' => url('/idcard_request/id_requestdashboard')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent