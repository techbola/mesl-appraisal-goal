@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Update Staff Details
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($staff, ['action' => ['StaffController@updateOfficeDetails', $staff->StaffRef], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('staff.form', ['buttonText' => 'Update Financial Details'])
		{{ Form::close() }}
	</div>
</div>
@endsection