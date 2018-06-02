@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Update Staff Financial Details
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($staff, ['action' => ['StaffController@updateFinanceDetails', $staff->StaffRef], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('staff.financeform', ['buttonText' => 'Update Financial Details'])
		{{ Form::close() }}
	</div>
</div>
@endsection