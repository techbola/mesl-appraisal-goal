@extends('layouts.master')

@section('content')
<div class="card-box">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Reciept
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($entry, ['action' => ['CashEntryController@update_receipt', $entry->CashEntryRef ], 'autocomplete' => 'off', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('cash_entries.receipts_form', ['buttonText' => 'Save'])
		{{ Form::close() }}
	</div>
</div>
@endsection