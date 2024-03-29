@component('mail::message')
Title : Leave Request Approval.

Dear {{$leave_request->current_approver->FullName}}

{{ $leave_request->requester->fullName }} requested a  ({{ $leave_request->NumberofDays }}) day(s) <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>. <br>

Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>

End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> 

You are required to approve or decline their request.

cheers.

@component('mail::button', ['url' => url('/leave_request/leave_approval')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

