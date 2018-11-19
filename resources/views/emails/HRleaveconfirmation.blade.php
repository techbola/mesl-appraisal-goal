@component('mail::message')
Title : Leave Request.

Dear {{$name->first_name}}

 A Leave Request awaits your confirmation. Click button to view your leave dashboard.

@component('mail::button', ['url' => 'http://cavidel.officemate.ng/approvers'])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
