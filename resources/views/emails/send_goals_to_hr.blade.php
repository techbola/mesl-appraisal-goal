@component('mail::message')

Hello,

<p>
	New appraisal submitted by {{ auth()->user() ->last_name . " " . auth()->user() ->first_name }} for
	{{ $staff->user->last_name . ' ' . $staff->user->first_name  }}.
</p>

@component('mail::button', ['url' => route('hr.index')])
	View Appraisal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent