@component('mail::message')
Title : Staff Onboarding.

{{-- Dear {{$name}} --}}
Dear HR

 A staff onboarding request has been done, Kindly check the dashboard to notify the new staff.

{{-- @component('mail::button', ['url' => url('/travel_request/admindashboard')])
Visit Officemate
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent