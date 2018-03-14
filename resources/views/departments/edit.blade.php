@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Department
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($department, ['action' => ['DepartmentController@update', $department->DepartmentRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('departments.form', ['buttonText' => 'Update Gender'])
		{{ Form::close() }}
	</div>
</div>
@endsection
