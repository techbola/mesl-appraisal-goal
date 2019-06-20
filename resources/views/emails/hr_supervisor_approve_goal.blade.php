@component('mail::message')

Hello,

<p>
	The goals set by {{ $staff->user->getFullNameAttribute() }} for period {{ $appraisal->period }} has been approved by the HR Officer.
</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
