@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="tit">
			Create Customers <span class="pull-right"><a href="editList" class="btn btn-info">Edit Staff Details</a></span>
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CustomerController@store', 'files' => true, 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('customers.form', ['buttonText' => 'Create Customer'])
		{{ Form::close() }}
	</div>
</div>
@endsection

