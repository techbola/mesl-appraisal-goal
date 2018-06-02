@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Bank Deposit
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($entry, ['action' => ['CashEntryController@update2', $entry->CashEntryRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('cash_entries.form', ['buttonText' => 'Post'])
		{{ Form::close() }}
	</div>
</div>
@endsection