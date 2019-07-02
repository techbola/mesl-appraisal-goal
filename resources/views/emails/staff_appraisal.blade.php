@component('mail::message')
# Staff Appraisal

Hello,

<p>
	New appraisal goals submitted by {{ auth()->user() ->last_name . " " . auth()->user() ->first_name }}.
</p>

@component('mail::button', ['url' => route('appraisal.supervisor.index')])
View Appraisal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
