@component('mail::message')
Title : Leave Request.

Dear {{$name->first_name}}

 A Leave Request awaits your confirmation. Click button to view your leave dashboard.
 

{{ $leave_request->requester->fullName }} requested a <b>({{ $leave_request->NumberofDays }})</b>day(s). <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>. <br>
Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>
End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> <br>
Leave Allowance: <b>{{ $leave_request->LeaveAllowance }}</b>

@component('mail::button', ['url' => url('/leave_request/hr_leave_approval')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
