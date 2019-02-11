@extends('layouts.master')
@section('buttons')
  <a href="{{ route('lot_description.index') }}" class="btn btn-info btn-rounded pull-right" >My Lot Descriptions</a>
@endsection
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Setup Lot Description</div>
  			<div class="clearfix"></div>
  			
  			{{ Form::open(['action' => 'ExpenseManagementController@lot_description_store', 'autocomplete' => 'off', 'files' => true, 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('expense_management.lot_description.form', ['buttonText' => 'Save'])
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



