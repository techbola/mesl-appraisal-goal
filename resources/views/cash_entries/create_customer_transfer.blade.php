@extends('layouts.master')

@section('content')
<div class="card-box">
	<div class="card-title">Account to Account Posting</div>
	<div>
		{{ Form::open(['action' => 'CashEntryController@customer_transfer_store', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('cash_entries.form_customer_transfer', ['buttonText' => 'Post Entry'])
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title">Postings between Accounts</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<table class="table tableWithSearch">
				<thead>
					<th>Acount Name</th>
					<th>Post Date</th>
					<th>Value Date</th>
					<th>Amount</th>
					<th>From</th>
					<th>To</th>
					<th>Bank Slip Number</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($cashentries as $cashentry)
						<tr>
						<td>{{ $cashentry->Customer }}</td>
						<td>{{ $cashentry->PostDate }}</td>
						<td>{{ $cashentry->ValueDate }}</td>
						<td>{{ $cashentry->Amount }}</td>
						<td>{{ $cashentry->GLIDDebit}}</td>
						<td>{{ $cashentry->GLIDCredit}}</td>
						<td>{{ $cashentry->BankSlipNo}}</td>
						<td class="actions">
							<a href="{{ route('customer_transfer.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-info">View / Post</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection
