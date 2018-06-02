@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Loan Cancellation
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($gl, ['action' => ['LoanScheduleController@terminateloan', $gl->GLRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('gls.loan_termination_form', ['buttonText' => 'Cancel Loan'])
		{{ Form::close() }}
	</div>
</div>
@endsection

