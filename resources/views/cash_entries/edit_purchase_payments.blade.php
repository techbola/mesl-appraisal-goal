@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Purchase Payments Update
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($cash_entry,['action' => ['CashEntryController@purchase_payments_update', $cash_entry->CashEntryRef], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('cash_entries.purchase_payments_form', ['buttonText' => 'Update Entry'])
		{{ Form::close() }}
	</div>
</div>
@endsection

