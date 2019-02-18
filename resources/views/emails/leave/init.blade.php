@component('mail::message')
Title : Leave Request.

Dear {{$leave_request->requester->fullName}}

You Requested a <b>{{ $leave_request->leave_type->LeaveType }}</b>.
and requested that your leave starts on: <b>{{ nice_date($leave_request->StartDate) }}</b> and ends on: <b>{{ nice_date($leave_request->ReturnDate) }}</b> <b>({{ $leave_request->NumberofDays }})</b>day(s).

Your requested is awaiting your supervisors approval and more top level approvers where required. You will receive notifications at every level of approval or rejection.

cheers.

@component('mail::button', ['url' => url('/leave_request/index')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
