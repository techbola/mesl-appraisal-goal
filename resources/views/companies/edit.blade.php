@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Gender
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($companies, ['action' => ['CompanyController@update', $Companies->CompanyRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('companies.form', ['buttonText' => 'Update Company Name'])
		{{ Form::close() }}
	</div>
</div>
@endsection

