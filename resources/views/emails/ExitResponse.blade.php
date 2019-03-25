@component('mail::message')
Title : Exit Interview Response.

Dear HR,

An Exit interview response has been sent by a staff, Kindly attend to it urgently.

@component('mail::button', ['url' => url('/staff/exit_interview')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent