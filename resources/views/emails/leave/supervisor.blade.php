@component('mail::message')
Title : Leave Request.

Dear {{$leave_request->supervisor->FullName}}

{{ $leave_request->requester->fullName }} Requested a <b>({{ $leave_request->NumberofDays }})</b>day(s). <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>. <br>
Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>
End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> 



You are required to approve or decline their request.

cheers.

@component('mail::button', ['url' => url('/leave_request/leave_approval_supervisor')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
