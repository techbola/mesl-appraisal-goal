@component('mail::message')
Title : Leave Request.

Dear {{$name->first_name}}

 Your Leave request has been approved. Click button to view your leave dashboard.

@component('mail::button', ['url' => 'http://cavidel.officemate.ng/leave_request/index'])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
