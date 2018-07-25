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
	<div class="card-title">Account to Account Posting</div>
	<div>
		{{ Form::open(['action' => 'CashEntryController@customer_transfer_store', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('cash_entries.form_customer_transfer', ['buttonText' => 'Post Entry'])
		{{ Form::close() }}
	</div>
</div> 
@endsection

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title">Postings between Accounts</div>
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
					<th>Action</th>
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
							<a href="{{ route('customer_transfer.edit',[$cashentry->CashEntryRef]) }}" class="btn btn-info">Edit Posting</a>
							<a href="#" data-id="{{ $cashentry->CashEntryRef }}" data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2"  class="btn btn-danger">Delete Posting</a>
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
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #fff">Posting Deletion Notification</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-7" style="color: #fff">
                     Please be notified that on click of the button posting will be deleted.
                    </div>
                    <div class="col-md-5 no-padding  ">
                      {{ Form::open(['action' => 'CashEntryController@delete_posting', 'autocomplete' => 'off', 'role' => 'form']) }}
                      <input type="hidden" name="CashEntryRef" value="" id="getValue">
                      <button type="submit" class="btn btn-danger">Delete Posting</button>
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

@push('scripts')

<script>
    
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var id = $(this).data('id');
            $("#modalFillIn #getValue").val(id);
          });

  </script>

	<script>

		$('#submit_bill').click(function(event) {
			$.post('/submit_bill_for_posting', $('#post_bill').serialize(), function(data, status) {
				$('#cash_entry_table').load(location.href + ' #cash_entry_table');
				$('#approve_notification').removeClass('hide');
				$('#approve_notification').fadeOut( 3000, "linear");
		    });

		    return false;

		});
		
	</script>
@endpush
