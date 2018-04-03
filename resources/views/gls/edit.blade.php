@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit General Ledger
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($gl, ['action' => ['GLController@update', $gl->GLRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('gls.form', ['buttonText' => 'Update GL'])
		{{ Form::close() }}
	</div>
</div>
@endsection

