@component('mail::message')
Title : Travel Request.

Dear Staff,

Your Travel Request has been approved by your supervisor. Click the button to view.

@component('mail::button', ['url' => url('/travel_request/create')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent