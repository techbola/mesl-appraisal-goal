@extends('layouts.master')

@section('content')
<div class="card-box">
	<div class="panel-heading">
		<div class="panel-title">
			Create New Staff 
		</div><hr>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'StaffController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('staff.form', ['buttonText' => 'Create New Staff '])
		{{ Form::close() }}
	</div>
</div>
@endsection
