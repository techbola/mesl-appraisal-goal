@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Gender
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($gender, ['action' => ['GenderController@update', $gender->GenderRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('genders.form', ['buttonText' => 'Update Gender'])
		{{ Form::close() }}
	</div>
</div>
@endsection

