@component('mail::message')
Title : Leave Request.

Dear {{$name}}

 A Leave Request awaits your approval. Click button to view request.

@component('mail::button', ['url' => 'http://cavidel.officemate.ng/leave_request/index'])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent