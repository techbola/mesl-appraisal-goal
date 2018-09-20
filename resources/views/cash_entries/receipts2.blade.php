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
			Create a New Receipt 
		</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CashEntryController@storeReceipts', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('cash_entries.receipts_form', ['buttonText' => 'Save'])
		{{ Form::close() }}
	</div>

	<div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #fff">Receipt Deletion Notification</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-7" style="color: #fff">
                     Please be notified that on click of the button receipt will be deleted.
                    </div>
                    <div class="col-md-5 no-padding  ">
                      {{ Form::open(['action' => 'CashEntryController@delete_receipt', 'autocomplete' => 'off', 'role' => 'form']) }}
                      <input type="hidden" name="CashEntryRef" value="" id="getValue">
                      <button type="submit" class="btn btn-danger">Delete Receipt</button>
                      {{ Form::close() }}
                    </div>
                  </div>
                  <p class="text-right sm-text-center hinted-text p-t-10 p-r-10" style="color: red">Please note this action is irreversible.</p>
                </div>
                <div class="modal-footer">
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>
@endsection


@section('bottom-content')
<div class="card-box">
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
					<th>DR Account</th>
					<th>CR Account</th>
					<th>Post Date</th>
					<th>Value Date</th>
					<th>Amount</th>
					{{-- <th>Company Slip Number</th>
					<th>Bank Slip Number</th> --}}
					<th></th>
				</thead>
				<tbody>
					@foreach ($cashentries as $cashentry)
						<tr>
						<td><input type="checkbox" name="cash_entry_ref[]" value="{{$cashentry->CashEntryRef}}"></td>
						<td>{{ $cashentry->gl_debit }}</td>
						<td>{{ $cashentry->gl_credit}}</td>
						<td>{{ $cashentry->PostDate }}</td>
						<td>{{ $cashentry->ValueDate }}</td>
						<td>{{ number_format($cashentry->Amount,2) }}</td>
						{{-- <td>{{ $cashentry->CompanySlipNo}}</td>
						<td>{{ $cashentry->BankSlipNo}}</td> --}}
						<td class="actions">
							<a href="{{ route('ReceiptEdit',[$cashentry->CashEntryRef]) }}" class="btn btn-success">Edit</a>
							<a href="#" data-id="{{ $cashentry->CashEntryRef }}" data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2"  class="btn btn-danger">Delete</a>
						</td> 
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ Form::close() }}
		</div>
	</div>
@endsection 

@push('scripts')

<script>
    
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var id = $(this).data('id');
            $("#modalFillIn #getValue").val(id);
          });

  </script>

@endpush


