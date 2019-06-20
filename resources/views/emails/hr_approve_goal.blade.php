@component('mail::message')

Hello,

<p>
	Your goals set for period {{ $appraisal->period }} has been approved by the HR Officer.
</p>

@component('mail::button', ['url' => route('staff.index')])
	View Appraisal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
