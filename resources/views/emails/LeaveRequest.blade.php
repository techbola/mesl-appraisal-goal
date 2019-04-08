@component('mail::message')
Title : Leave Request.

Dear {{$name->first_name}}

 @if($leave_request->NotifyFlag == 1 && $leave_request->ApprovedFlag == 0)
 	A Leave Request awaits your approval. Click button to view request.
 @elseif($leave_request->ApprovedFlag == 1 && $leave_request->NotifyFlag == 1)
	Your Leave request has been approved.
@elseif($leave_request->ApprovedFlag == 0 && $leave_request->RejectionFlag == 1)

Your leave request has been rejected by HR.

Leave Request Details
---------------------


No of Days:  ({{ $leave_request->NumberofDays }}) day(s) <b>{{ $leave_request->leave_type->LeaveType }} Leave</b>. <br>

Start Date: <b>{{ nice_date($leave_request->StartDate) }}</b> <br>

End Date: <b>{{ nice_date($leave_request->ReturnDate) }}</b> 


Cheers.

@endif



@component('mail::button', ['url' => url('/leave_request/hr_leave_approval')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
