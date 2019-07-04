@component('mail::message')

Hello,

<p>
	Your goals set for period {{ $appraisal->period }} has been rejected.
</p>

@component('mail::button', ['url' => route('appraisal.staff.index')])
	View Appraisal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
