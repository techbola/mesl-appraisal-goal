@extends('layouts.master')

@section('content')

<div class="card-box">
	<div class="card-title pull-left">Edit Lot Description</div>
	<div class="pull-right">
		<div class="col-xs-12">
			{{-- <input type="text" class="search-table form-control pull-right" placeholder="Search"> --}}
		</div>
	</div>
	<div class="clearfix"></div>
	{{ Form::model($lot_desc, ['action' => ['ExpenseManagementController@lot_description_update', $lot_desc->LotDescriptionRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('expense_management.lot_description.form', ['buttonText' => 'Update'])
	{{ Form::close() }}
</div>
@endsection


