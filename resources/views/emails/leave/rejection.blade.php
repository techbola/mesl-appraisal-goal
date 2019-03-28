@component('mail::message')
Title : Leave Request.

Dear {{$leave_request->requester->fullName}}

Your leave request has been rejected by your supervisor.

Leave Request Details
---------------------


No of Days:  ({{ $leave_request->NumberofDays }}) day(s) <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>. <br>

Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>

End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> 


Cheers.

@component('mail::button', ['url' => url('/leave_request/index')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
