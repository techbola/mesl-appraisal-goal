@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Create Transaction 
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'TransactionController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('transactions.form', ['buttonText' => 'Create Transaction'])
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
			Transactions Listing
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
					<th>Posting Type</th>
					<th>GL</th>
					<th>Post Date</th>
					<th>Value Date</th>
					<th>Amount</th>
					<th>Transaction Type</th>
					<th>Narration</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($transactions as $transaction)
						<tr>
						<td>{{ $transaction->PostingType }}</td>
						<td>{{ $transaction->GL }}</td>
						<td>{{ $transaction->PostDate}}</td>
						<td>{{ $transaction->ValueDate }}</td>
						<td>{{ $transaction->Amount }}</td>
						<td>{{ $transaction->TransactionType }}</td>
						<td>{{ $transaction->Narration }}</td>
						<td class="actions">
							<a href="{{ route('transactions.edit',[$transaction->TransactionRef]) }}" class="btn">EDIT</a>
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
