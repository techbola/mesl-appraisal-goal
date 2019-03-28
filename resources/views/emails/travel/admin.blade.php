@component('mail::message')
Travel Request Approval.
--------------

Dear Admin,

{{$travel_request->requester_name->fullName}} requested to travel from <b>({{ nice_date($travel_request->DepartureDate) }})</b> to <b>({{ nice_date($travel_request->ArrivalDate) }})</b>. <br>

Travel Purpose: <b>{{ $travel_request->travel_purpose->TravelPurpose }}</b> <br>
Travel Description: <b>{{ $travel_request->PurposeDescription }}</b>

<br>

*{{ $travel_request->TravelType == 1 ? 'From: ' .$travel_request->travel_from_state->State : ' From: '.$travel_request->travel_from_state->State ?? '-' }}* |
*{{ $travel_request->TravelType == 1 ? 'To: ' .$travel_request->travel_to_state->State : ' To: '.$travel_request->travel_to_country->Country ?? '-' }}*

Travellers
----------
@if(count($travel_request->travellers) > 0)

@foreach($travel_request->travellers as $tr)
@if($tr->StaffID != NULL)
**MESL STAFF:  {{ $tr->internel_traveller->FullName }} <br>
@endif
@if($tr->FullName != NULL)
**Visitor: {{ $tr->FullName }}
@endif
@endforeach

@else
No Travellers
@endif


Your are required to decline or approve the request.

Cheers.

@component('mail::button', ['url' => url('/travel_request/final-admindashboard')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

