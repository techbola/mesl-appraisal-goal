@component('mail::message')
Title : Exit Interview Form.

Dear {{$user->FullName}},

Sequel to your notification to Human Resources Department on your exit from Manistream Energy Solutions Limited, we kindly reuqest that you click the link below to answer a short questionnaire.

@component('mail::button', ['url' => url('/exit/create')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent