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
@section('content')
<div class="card-box">
	<div class="panel-heading">
		<div class="panel-title">
			Purchase & Expense Journals
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CashEntryController@storepurchase_on_credits', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('cash_entries.purchase_on_credits_form', ['buttonText' => 'Save'])
		{{ Form::close() }}
	</div>
</div>
@endsection


@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title">Purchase Journal Entries</div>
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
			<button type="submit" id="submit_bill" class="btn btn-info btn-lg">Send for Approval</button>
			<table class="table tableWithSearch" id="cash_entry_table">
				<thead>
					<th>
						<div class="checkbox check-info">
                          <input type="checkbox" id="select-all">
                          <label for="select-all" class="text-white">Bulk Select</label>
                        </div>
					</th>
					<th>DR Account</th>
					<th>CR Account</th>
					<th>Post Date</th>
					<th>Value Date</th>
					<th>Amount</th>
					<th>Narration</th>
					{{-- <th>Inputter</th> --}}
					{{-- <th></th> --}}
				</thead>
				<tbody>
					@foreach ($cashentries as $cashentry)
						<tr>
						<td><input type="checkbox" class="select-all-child" name="CashEntryRef[]" id="xyz" value="{{ $cashentry->CashEntryRef }}"></td>
						<td>{{ $cashentry->gl_debit }}</td>
						<td>{{ $cashentry->gl_credit}}</td>
						<td>{{ $cashentry->PostDate }}</td>
						<td>{{ $cashentry->ValueDate }}</td>
						<td>{{ number_format($cashentry->Amount,2) }}</td>
						<td>{{ $cashentry->Narration}}</td> 
						{{-- <td>{{ get_staff_name($cashentry->InputterID) }}</td> --}}
						<td class="actions">
							<a href="{{ route('purchase_on_credits.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-info">Edit</a>
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

	  <script language="javascript">
		$(function(){
		    // add multiple select / deselect functionality
		    $("#select-all").click(function () {
		          $('.select-all-child').prop('checked', this.checked);
		    });

		    // if all checkbox are selected, check the selectall checkbox
		    // and viceversa
		    $(".select-all-child").click(function(){

		        if($(".select-all-child").length == $(".select-all-child:checked").length) {
		            $("#select-all").prop("checked", "checked");
		        } else {
		            $("#select-all").removeAttr("checked");
		        }

		    });


		    $('#submit_bill').click(function(event) {
			$.post('/submit_post_bill_purchase',$('#post_bill').serialize() , function(data, status) {
				$('#cash_entry_table').load(location.href + ' #cash_entry_table');
				$('#approve_notification').removeClass('hide');
				$('#approve_notification').fadeOut( 3000, "linear");
			});
			return false;
		});
		});
	</script>
@endpush



