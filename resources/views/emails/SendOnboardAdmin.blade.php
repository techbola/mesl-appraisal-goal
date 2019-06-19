@component('mail::message')
Title : Staff Onboarding.

{{-- Dear {{$name}} --}}
Dear Team,

 A new staff onboarding request from HR awaits your attention. Click button to see the list of things to be done.

@component('mail::button', ['url' => url('/staff/onboard_dashboard_admin')])
Visit Officemate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent