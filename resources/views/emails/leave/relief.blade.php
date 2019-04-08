@component('mail::message')
Title : Leave Request.

Dear {{$leave_request->relief_officer->FullName}},

{{ $leave_request->requester->fullName }} requested a <b>({{ $leave_request->NumberofDays }})</b>day(s). <b>{{ $leave_request->leave_type->LeaveType }} Leave</b> and selected you as the relief officer. The details of the leave are as shown below: <br>
Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>
End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> 

The request has been approved and needs your attention. Please click the link below to view handover note.


Cheers.

@component('mail::button', ['url' => url("/leave_request/hon/$leave_request->LeaveReqRef")])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
