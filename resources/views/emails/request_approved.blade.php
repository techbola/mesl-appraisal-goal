@component('mail::message')
Title : Travel Request.

Dear Approver

 Your Travel Request has been approved. Click the button to view.

@component('mail::button', ['url' => 'http://127.0.0.1:5500/travel_request/create'])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent