@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Means Of Identification
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($identification, ['action' => ['GenderController@update', $identification->GenderRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('identifications.form', ['buttonText' => 'Update Means of Identification'])
		{{ Form::close() }}
	</div>
</div>
@endsection

