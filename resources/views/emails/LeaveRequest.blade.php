@component('mail::message')
Title : Leave Request.

Dear {{$name->first_name}}

 @if($leave_request->NotifyFlag == 1 && $leave_request->ApprovedFlag == 0)
 	A Leave Request awaits your approval. Click button to view request.
 @elseif($leave_request->ApprovedFlag == 1 && $leave_request->NotifyFlag == 1)
	Your Leave request has been approved.
@elseif($leave_request->ApprovedFlag == 0 && $leave_request->RejectionFlag == 1)
	{{ !is_null($leave_request->ReliefOfficerID) ?  'Leave request has been rejected' :  'Leave request has been rejected' }}
 @endif

 @if(!is_null($leave_request->ReliefOfficerID) && $leave_request->RejectionFlag == 1)
 	You received this email due to your role as a relief officer 
 @endif

@component('mail::button', ['url' => url('/leave_request/index')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}   
@endcomponent
