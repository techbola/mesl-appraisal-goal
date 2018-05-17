@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit General Ledger
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($risk_register, ['action' => ['RiskRegisterController@update', $risk_register->RiskRegisterRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('risk_registers.form', ['buttonText' => 'Update Entry'])
		{{ Form::close() }}
	</div>
</div>
@endsection

