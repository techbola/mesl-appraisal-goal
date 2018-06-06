@extends('layouts.master')

@section('content')
<div class="card-box">
	<div class="card-title">
		Imprest Posting
	</div>
	{{ Form::open(['action' => 'CashEntryController@storeImprest', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
	@include('cash_entries.imprest_form', ['buttonText' => 'Save'])
	{{ Form::close() }}
</div>


{{-- TABLE --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title">Cash Entry</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>

		<table class="table tableWithSearch">
			<thead>
				<th>Acount Name</th>
				<th>Post Date</th>
				<th>Value Date</th>
				<th>Amount</th>
				{{-- <th>Company Slip Number</th>
				<th>Bank Slip Number</th> --}}
				<th>Narration</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($cashentries as $cashentry)
					<tr>
					<td>{{ $cashentry->Customer }}</td>
					<td>{{ $cashentry->PostDate }}</td>
					<td>{{ $cashentry->ValueDate }}</td>
					<td>{{ number_format($cashentry->Amount,2) }}</td>
					{{-- <td>{{ $cashentry->CompanySlipNo}}</td>
					<td>{{ $cashentry->BankSlipNo}}</td> --}}
					<td>{{ $cashentry->Narration}}</td>
					<td class="actions">
						{{-- <a href="{{ route('cash_entries.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-info">View / Post</a> --}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- END PANEL -->
</div>
@endsection
