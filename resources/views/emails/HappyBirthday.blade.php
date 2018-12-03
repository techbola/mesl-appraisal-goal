@component('mail::message')
# Dear {{ $staff->first_name }},

We would like to take a moment of your time to wish you a happy birthday as you add another year today. May this day and the year to follow be full of joy.

We wish you a successful and fruitful year ahead.

{{-- Happy Birthday and all the best to you in the year to come! --}}

{{-- @component('mail::button', ['url' => 'http://cavidel.officemate.ng/'])
Visit Officemate
@endcomponent --}}

Best Wishes,<br>
{{ $staff->company->Company ?? config('app.name') }}
@endcomponent
