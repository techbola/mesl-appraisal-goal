@component('mail::message')
Title : Leave Request Approval.

Dear {{$leave_request->current_approver->FullName}}

{{ $leave_request->requester->fullName }} Requested a <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>.
and requested that their leave starts on: <b>{{ nice_date($leave_request->StartDate) }}</b> and ends on: <b>{{ nice_date($leave_request->ReturnDate) }}</b> <b>({{ $leave_request->NumberofDays }})</b>day(s).

You are required to approve or decline their request.

cheers.

@component('mail::button', ['url' => url('/leave_request/index')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
