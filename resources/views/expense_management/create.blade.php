@extends('layouts.master')
@section('buttons')
  <a href="{{ route('expense_management.index') }}" class="btn btn-info btn-rounded pull-right" >My Expense Requests</a>
@endsection
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Request Expense</div>
  			<div class="clearfix"></div>
  			
  			{{ Form::open(['action' => 'ExpenseManagementController@store', 'autocomplete' => 'off', 'files' => true, 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('expense_management.form', ['buttonText' => 'Send Request'])
			{{ Form::close() }}

  	</div>

  	<div class="card-box hide">
  		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
  	</div>
  	<!-- END PANEL -->

@endsection



