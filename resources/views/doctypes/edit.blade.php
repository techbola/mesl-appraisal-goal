@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Document Type
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($DocType, ['action' => ['DocTypeController@update', $DocType->DocTypeRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('doctypes.form', ['buttonText' => 'Update Document Type'])
		{{ Form::close() }}
	</div>
</div>
@endsection
