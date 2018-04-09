@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Branch
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($branch, ['action' => ['BranchController@update', $branch->BranchRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('branches.form', ['buttonText' => 'Update Branch'])
		{{ Form::close() }}
	</div>
</div>
@endsection

