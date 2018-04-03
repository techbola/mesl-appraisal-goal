@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Loan
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($gl, ['action' => ['GLController@update2', $gl->GLRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('gls.form2', ['buttonText' => 'Update Loan'])
		{{ Form::close() }}
	</div>
</div>
@endsection

