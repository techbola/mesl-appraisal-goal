@component('mail::message')

Hello,

<p>
	Your goals set for period {{ $appraisal->period }} has been approved.
</p>

@component('mail::button', ['url' => route('staff.index')])
	View Appraisal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
