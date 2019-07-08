@if(!auth()->user()->staff->SupervisorFlag && !auth()->user()->hasRole('HR Supervisor'))

	<li>
		<a href="{{ route('appraisal.staff.index') }}">Goal Setting</a>
	</li>
	<li>
		<a href="{{ route('appraisal.staff.appraisals') }}">Appraisal List</a>
	</li>

@elseif(auth()->user()->hasRole('HR Supervisor') && auth()->user()->staff->SupervisorFlag)

	<li>
		<a href="{{ route('appraisal.levels.index') }}">Levels</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hr.index') }}">Behavioural Categories</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hr.behavioural.items') }}">Behavioural Items</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hrStaffGoals') }}">Staff Goals</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hrStaffAppraisals') }}">Staff Appraisals</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hrAllStaffIndexAppraisals') }}">All Staff Appraisals</a>
	</li>

@elseif(auth()->user()->hasRole('HR Supervisor'))

	<li>
		<a href="{{ route('appraisal.levels.index') }}" class="detailed">Levels</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hr.index') }}">Behavioural Categories</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hr.behavioural.items') }}">Behavioural Items</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hrStaffGoals') }}">Staff Goals</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hrStaffAppraisals') }}">Staff Appraisals</a>
	</li>

	<li>
		<a href="{{ route('appraisal.hrAllStaffIndexAppraisals') }}">All Staff Appraisals</a>
	</li>

@elseif(auth()->user()->staff->SupervisorFlag)

{{--	<li>--}}
{{--		<a href="{{ route('appraisal.supervisorNewGoal') }}">Goal Settings</a>--}}
{{--	</li>--}}
{{--	<li>--}}
{{--		<a href="{{ route('appraisal.supervisorAppraisals') }}">Appraisal List</a>--}}
{{--	</li>--}}
	<li>
		<a href="{{ route('appraisal.supervisor.index') }}">Staff Appraisals</a>
	</li>

@endif