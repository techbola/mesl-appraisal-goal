@component('mail::message')
Title : Leave Request.

Dear {{$leave_request->requester->fullName}}

You requested a  ({{ $leave_request->NumberofDays }}) day(s) <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>. <br>

Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>

End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> 


Your request is awaiting your supervisor's approval and you will be notified at every level of approval or rejection.

cheers.

@component('mail::button', ['url' => url('/leave_request/index')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
