@component('mail::message')
Title : Exit Interview Form.

Dear {{$user->FullName}},

Sequel to your notification to HR on your planned exit from Manistream Energy Solutions Limited, we kindly request that you follow the link below to answer a short questionnaire.

@component('mail::button', ['url' => url('/exit/create')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent