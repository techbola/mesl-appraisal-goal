@extends('layouts.master')
@push('styles')
	<style>
		.notice{
			width: 500px;
			background: #74ea74 !important;
			color: #000;
			padding: 20px;
			margin: 0px auto;
		}

		.modal.fade.fill-in.in {
    background-color: rgba(121, 120, 120, 0.85);
}
	</style>
@endpush
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
		<div class="notice text-center hide" id="approve_notification">
				<p>Posted Successfully</p>
			</div><br>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
		{{ Form::open(['id'=>'post_bill','autocomplete' => 'off', 'role' => 'form']) }}
			<button type="submit" id="submit_bill" class="btn btn-info btn-lg">Send for Approval</button>
		<table class="table tableWithSearch"  id="cash_entry_table">
			<thead>
				<th></th>
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
					<td><input type="checkbox" name="CashEntryRef[]" value="{{ $cashentry->CashEntryRef }}"></td>
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
		{{ Form::close() }}
	</div>
	<!-- END PANEL -->
</div>
@endsection

@push('scripts')

<script>
    
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var id = $(this).data('id');
            $("#modalFillIn #getValue").val(id);
          });

  </script>

	<script>

		$('#submit_bill').click(function(event) {
			$.post('/submit_imprest_for_posting', $('#post_bill').serialize(), function(data, status) {
				$('#cash_entry_table').load(location.href + ' #cash_entry_table');
				$('#approve_notification').removeClass('hide');
				$('#approve_notification').fadeOut( 3000, "linear");
		    });

		    return false;

		});
		
	</script>
@endpush
