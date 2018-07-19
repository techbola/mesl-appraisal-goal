@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Payments 
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CashEntryController@storePayments', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('cash_entries.payment_form', ['buttonText' => 'Save'])
		{{ Form::close() }}
	</div>
</div>
@endsection


@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			<div class="panel-title">
			Cash Entry
			</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table tableWithSearch">
				<thead>
					<th>Acount Name</th>
					<th>Post Date</th>
					<th>Value Date</th>
					<th>Amount</th>
					<th>Company Slip Number</th>
					<th>Bank Slip Number</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($cashentries as $cashentry)
						<tr>
						<td>{{ $cashentry->Customer }}</td>
						<td>{{ $cashentry->PostDate }}</td>
						<td>{{ $cashentry->ValueDate }}</td>
						<td>{{ number_format($cashentry->Amount,2) }}</td>
						<td>{{ $cashentry->CompanySlipNo}}</td>
						<td>{{ $cashentry->BankSlipNo}}</td>
						<td class="actions">
							<a href="{{ route('cash_entries.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-info">View / Post</a>
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



