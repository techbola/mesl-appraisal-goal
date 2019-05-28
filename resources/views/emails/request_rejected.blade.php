@component('mail::message')

Dear Staff,

Your Travel Request was Rejected. Click button to view why your request wasn't approved. <br>

Reason
------
{{ $travel_request->RejectionComment ?? ' - ' }}


@component('mail::button', ['url' => url('/travel_request/create')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent