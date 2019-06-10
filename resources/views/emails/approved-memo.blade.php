@component('mail::message')


{{ $is_initiator ? 'Dear '. $memo->initiator->FullName. ',' : null}}

@if($is_initiator)
Your Memo has been approved.

cheers.
@else
Memo request from {{ $memo->initiator->FullName }} has been approved.

cheers.
@endif

@component('mail::button', ['url' => url('/memos')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

