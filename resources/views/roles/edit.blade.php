@extends('layouts.master')
@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Update Role 
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($role,['action' => ['RoleController@update', $role->id ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form', 'method' => 'patch']) }}
		@include('roles.form', ['buttonText' => 'Update Role'])
		{{ Form::close() }}
	</div>
</div>
@endsection


