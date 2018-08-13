@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Purchase Payments
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CashEntryController@storepurchase_payments', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('cash_entries.purchase_payments_form', ['buttonText' => 'Save'])
		{{ Form::close() }}
	</div>
</div>
@endsection


@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title">Purchase Payments Entries</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<div class="notice text-center hide" id="approve_notification">
				<p>Posted Successfully</p>
			</div><br>
			{{ Form::open(['id'=>'post_bill','autocomplete' => 'off', 'role' => 'form']) }}
			{{ method_field('PATCH') }}
			<button type="submit" id="submit_bill" class="btn btn-info btn-lg">Send for Approval</button>
			{{-- <a href="#" id="submit_bill" class="btn btn-info btn-lg"  title="">Send for Approval</a> --}}
			<table class="table tableWithSearch" id="cash_entry_table">
				<thead>
					<th>Action</th>
					<th>DR Account</th>
					<th>CR Account</th>
					<th>Post Date</th>
					<th>Value Date</th>
					<th>Amount</th>
					<th>Narration</th>
					{{-- <th></th> --}}
				</thead>
				<tbody>
					@foreach ($cashentries as $cashentry)
						<tr>
						<td><input type="checkbox" name="CashEntryRef[]" value="{{ $cashentry->CashEntryRef }}"></td>
						<td>{{ $cashentry->gl_debit }}</td>
						<td>{{ $cashentry->gl_credit}}</td>
						<td>{{ $cashentry->PostDate }}</td>
						<td>{{ $cashentry->ValueDate }}</td>
						<td>{{ number_format($cashentry->Amount,2) }}</td>
						<td>{{ $cashentry->Narration}}</td> 
						<td class="actions">
							<a href="{{ route('purchase_payments.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-info">Edit</a>
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


@push('scripts')
	<script>
		$('#submit_bill').click(function(event) {
			$.post('/submit_post_bill_purchase',$('#post_bill').serialize() , function(data, status) {
				$('#cash_entry_table').load(location.href + ' #cash_entry_table');
				$('#approve_notification').removeClass('hide');
				$('#approve_notification').fadeOut( 3000, "linear");
			});
			return false;
		});
	</script>
@endpush



