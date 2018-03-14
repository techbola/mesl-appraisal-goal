@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Country
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($country, ['action' => ['CountryController@update', $country->CountryRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('countries.form', ['buttonText' => 'Update Country'])
		{{ Form::close() }}
	</div>
</div>
@endsection

