@extends('layouts.master')

@section('content')
<div class="card-box">
		<div class="card-title">
			Create a New Receipt 
		</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CashEntryController@storeReceipts', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('cash_entries.receipts_form', ['buttonText' => 'Save'])
		{{ Form::close() }}
	</div>
@endsection


@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Unapproved Receipt(s) 
			</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
		<div class="panel-body">
			{{ Form::open(['action' => 'CashEntryController@postReceipts', 'autocomplete' => 'off', 'role' => 'form']) }}
			<input type="submit" class="btn btn-sm btn-primary" value="Send Receipt for Approval">
			
			<table class="table tableWithSearch">
				<thead>
					<th></th>
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
						<td><input type="checkbox" name="cash_entry_ref[]" value="{{$cashentry->CashEntryRef}}"></td>
						<td>{{ $cashentry->Customer }}</td>
						<td>{{ $cashentry->PostDate }}</td>
						<td>{{ $cashentry->ValueDate }}</td>
						<td>{{ number_format($cashentry->Amount,2) }}</td>
						<td>{{ $cashentry->CompanySlipNo}}</td>
						<td>{{ $cashentry->BankSlipNo}}</td>
						<td class="actions">
							<a href="{{ route('cash_entries.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-success">View / Post</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ Form::close() }}
		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection 

{{-- @push('scripts')
	<script>
		$('#send_for_approval').click(function(event) {
			alert('jesus');
		});
	</script>
@endpush
 --}}


