@extends('layouts.master')

@section('content')
<div class="card-box">
		<div class="card-title">Edit Document Type</div>

		{{ Form::model($DocType, ['action' => ['DocTypeController@update', $DocType->DocTypeRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('doctypes.form', ['buttonText' => 'Update'])
		{{ Form::close() }}
</div>
@endsection
