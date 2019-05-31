@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Daily Interest
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($holiday, ['action' => ['HolidayController@update', $holiday->HolidayRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('holidays.form', ['buttonText' => 'Update'])
		{{ Form::close() }}
	</div>
</div>
@endsection

