@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Account to Account Posting
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($cash_entry,['action' => ['CashEntryController@customer_transfer_update', $cash_entry->CashEntryRef], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('cash_entries.form_customer_transfer', ['buttonText' => 'Update Entry'])
		{{ Form::close() }}
	</div>
</div>
@endsection

