@component('mail::message')
Travel Request.
--------------

Dear {{$travel_request->requester_name->fullName}},

You requested to travel from <b>({{ nice_date($travel_request->DepartureDate) }})</b> to <b>({{ nice_date($travel_request->ArrivalDate) }})</b>. <br>

Travel Details
--------------
Travel Purpose: <b>{{ $travel_request->travel_purpose->TravelPurpose ?? '-' }}</b> <br>
Travel Description: <b>{{ $travel_request->PurposeDescription ?? '-' }}</b>

<br>

{{ $travel_request->TravelType == 1 ? 'From: ' .$travel_request->travel_from_state->State : ' From: '.$travel_request->travel_from_state->State ?? '-' }}
{{ $travel_request->TravelType == 1 ? 'To: ' .$travel_request->travel_to_state->State : ' To: '.$travel_request->travel_to_country->Country ?? '-' }}

Travellers 
----------
@if(count($travel_request->travellers) > 0)
@foreach($travel_request->travellers as $tr)
@if($tr->StaffID != NULL)
MESL STAFF:  {{ $tr->internel_traveller->FullName }}
@endif

@if($tr->FullName != NULL)
Visitor: {{ $tr->FullName }}
@endif
@endforeach
@else
No Travellers
@endif


Your request is awaiting your supervisor's approval and you will be notified upon approval or rejection.

cheers.

@component('mail::button', ['url' => url('/travel_request/create')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
