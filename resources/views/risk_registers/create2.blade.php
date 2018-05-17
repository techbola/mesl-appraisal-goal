@extends('layouts.master')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			Create Loan For Customer
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'GLController@storeLoan', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{-- ss --}}
		@include('gls.form2', ['buttonText' => 'Create Loan'])
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">
				Loan Listing
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
					<th>GL Ref</th>
					<th>Customer</th>
					<th>Account Type</th>
					<th>Currency</th>
					<th>Branch</th>
					<th>AccountNo</th>
					<th>Loan Amount</th>
					<th>Loan Type</th>
					<th>BookBalance</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($gls as $gl)
					<tr>
						{{-- <td>{{ $gl->GLRef }}</td>
						<td>{{ $gl->Customer }}</td>
						<td>{{ $gl->AccountType }}</td>
						<td>{{ $gl->Currency}}</td>
						<td>{{ $gl->Branch }}</td>
						<td>{{ $gl->AccountNo }}</td>
						<td>{{ number_format($gl->LoanAmount,2)}}</td>
						<td>{{ $gl->loan_type ?? '-' }}</td>
						<td>{{ $gl->BookBalance }}</td> --}}

						<td>{{ $gl->GLRef }}</td>
						<td>{{ $gl->customer->Customer }}</td>
						<td>{{ $gl->account_type->AccountType }}</td>
						<td>{{ $gl->currency->Currency }}</td>
						<td>{{ $gl->branch->Branch }}</td>
						<td>{{ $gl->AccountNo }}</td>
						<td>{{ number_format($gl->LoanAmount,2)}}</td>
						<td>{{ $gl->loan_type->LoanType ?? '-' }}</td>
						<td>{{ $gl->BookBalance }}</td>
						<td class="actions">
							<a href="{{route('gls.edit2',[$gl->GLRef]) }}" class="btn btn-sm">Edit</a>
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
