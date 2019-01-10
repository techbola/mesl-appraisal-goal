@extends('layouts.master')

@section('content')

<div class="card-box">
	<div class="card-title pull-left">Edit Request</div>
	<div class="pull-right">
		<div class="col-xs-12">
			<input type="text" class="search-table form-control pull-right" placeholder="Search">
		</div>
	</div>
	<div class="clearfix"></div>
	{{ Form::model($expense_management, ['action' => ['ExpenseManagementController@update', $expense_management->ExpenseManagementRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('expense_management.form', ['buttonText' => 'Update Request'])
	{{ Form::close() }}
</div>
@endsection


