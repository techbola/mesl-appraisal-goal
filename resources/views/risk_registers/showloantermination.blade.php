@extends('layouts.master')


@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
				Loan Cancellation List
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
					<th>BookBalance</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($gls as $gl)
					<tr>
						<td>{{ $gl->GLRef }}</td>
						<td>{{ $gl->Customer }}</td>
						<td>{{ $gl->AccountType }}</td>
						<td>{{ $gl->Currency}}</td>
						<td>{{ $gl->Branch }}</td>
						<td>{{ $gl->AccountNo }}</td>
						<td>{{ number_format($gl->LoanAmount,2)}}</td>
						<td>{{ $gl->BookBalance }}</td>
						<td class="actions">
							<a href="{{route('edit_termination',[$gl->GLRef]) }}" class="btn">Cancel Loan</a>
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
