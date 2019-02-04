@component('mail::message')
Title : Travel Request.

Dear Staff

 Your Travel Request was Rejected. Click button to view why your request wasn't approved.

@component('mail::button', ['url' => 'http://127.0.0.1:5500/travel_request/create'])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent