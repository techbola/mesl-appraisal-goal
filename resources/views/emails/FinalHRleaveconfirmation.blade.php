@component('mail::message')
Title : Leave Request.

Dear {{$name->first_name}}

 Your Leave Request has been approved.

@component('mail::button', ['url' => url('/leave_request/index')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
