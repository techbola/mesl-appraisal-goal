@component('mail::message')
Title : Travel Request.

{{-- Dear {{$name}} --}}
Dear Approver

 A Travel Request awaits your approval. Click button to view request.

@component('mail::button', ['url' => url('/travel_request/admindashboard')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent