@component('mail::message')
Title : Travel Request.

Dear Staff

 Your Travel Request was Rejected. Click button to view why your request wasn't approved.

@component('mail::button', ['url' => url('/travel_request/create')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent