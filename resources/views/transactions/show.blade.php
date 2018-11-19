@extends('layouts.master')

@push('styles')

<style>
	tfoot{
      display: table-header-group;
     }
</style>

@endpush

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="panel panel-default" id="print-content">
		<div class="panel-heading">
			<div class="panel-title">
				Customer Account Statement.
			</div><hr>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
				@if(isset($statements))
					@foreach($trans as $tran)
						<div class="col-md-4"><p style ="font-size :17px">Name :</p></div>
						<div class="col-md-8"><p style ="font-size :17px; color : #0090d9">{{$tran->Customer}}</p></div>
					@if(!empty($tran->HomeAddress))
					<div class="col-md-4"><p style ="font-size :17px">Address :</p></div>
					<div class="col-md-8">
					<p style ="font-size :17px; color : #0090d9">{{$tran->HomeAddress}}</p>
					</div>
					@endif
					@if(!empty($tran->Telephone))
					<div class="col-md-4"><p style ="font-size :17px">Phone Number :</p></div>
					<div class="col-md-8"><p style ="font-size :17px; color : #0090d9">{{ $tran->Telephone}}</p></div><br>
					@endif
					@if(!empty($tran->BVN))
					<div class="col-md-4"><p style ="font-size :17px">BVN Number :</p></div>
					<div class="col-md-8"><p style ="font-size :17px; color : #0090d9">{{$tran->BVN}}</p></div>
					@endif
				</div>

				<div class="col-md-6">
					<div class="col-md-5"><p style ="font-size :17px">Account No :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{$tran->AccountNumber}}</p></div>
					<div class="col-md-5"><p style ="font-size :17px">Account Type :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{$tran->AccountType}}</p></div>
					<div class="col-md-5"><p style ="font-size :17px">Currency :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{$tran->Currency}}</p></div><br>
					<div class="col-md-5"><p style ="font-size :17px">Book Balance :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{ number_format( $tran->BookBalance,2)}}</p></div><br>
					<div class="col-md-5"><p style ="font-size :17px">Cleared Balance :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{ number_format( $tran->ClearedBalance,2)}}</p></div>
					@endforeach
					@endif
				</div>
			</div><hr>
			<div class="table-responsive">
				<table class="table tableWithExportOptions" id="transactions">
				<thead>
					<th>Action</th>
					<th>Transaction Date</th>
					<th>Value Date</th>
					<th>Debits</th>
					<th>Credits</th>
					<th>Balance</th>
					<th>Naration</th>
				</thead>
				<tfoot class="thead">
					<th>Action</th>
					<th>Transaction Date</th>
					<th>Value Date</th>
					<th>Debits</th>
					<th>Credits</th>
					<th>Balance</th>
					<th>Naration</th>
					</tfoot>
				<tbody>
				@if(isset($statements))
					@foreach($statements as $statement)
					<tr>
						<td><a href="#" data-tref="{{ $statement->TransactionCode }}" class="btn btn-sm btn-complete bill-modal-trigger">Details</a></td>
						<td>{{$statement->PostDate}}</td>
						<td>{{$statement->ValueDate}}</td>
						<td>{{number_format($statement->Debit,2) }}</td>
						<td>{{number_format($statement->Credit,2) }}</td>
						<td>{{number_format($statement->Balance,2) }}</td>
						<td>{{$statement->Narration}}</td>
					</tr>
					@endforeach
				@endif
				</tbody>
			</table>
			</div>
		</div>
	</div><br><br>
	<!-- END PANEL -->

	
    <div class="bill-modal modal fade " tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Transaction details  <span class="text-info bill-owner"></span></h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered" id="bill-item-table">
              <thead>
                <th width="25%">Details</th>
                <th>Post Date</th>
                <th>Value Date</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Narration</th>
              </thead>

              <tbody>
                
              </tbody>

            </table>
          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> --}}
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

	@endsection

	@push('scripts')
<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
<script>
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
	
  	 var settings = {
    
    sDom: 'rB<"pull-right">tip',
buttons: [
            'copy', 'excel', 'pdf', 'print', {
                extend: 'colvis',
                columns: ':gt(0)',
                text: 'Columns'
            }
        ],
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
    
    "iDisplayLength": 20,
  
    fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions'));
    }
};


var table = $('#transactions').DataTable(settings);
 $('#transactions tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });

 $('.table').on('click', '.bill-modal-trigger', function(event) {
    event.preventDefault();
    var transaction_details = $(this).data('tref');
    // console.log(transaction_details);
    // $('#bill-item-table').DataTable();
    $('#bill-item-table tbody').html(' ');
    $.post('/get-transaction-details', {ref: transaction_details}, function(data, textStatus, xhr) {
      console.log(data.data);
      $('.bill-owner').html(data.data[0].Customer);
      var bill_modal_body = $.each(data.data, function(index, val) {
        $('#bill-item-table tbody').append(` <tr>
            <td width="25%">${val.Details}</td>
            <td>${val.PostDate}</td>
            <td>${val.ValueDate}</td>
            <td class="text-danger" style="font-weight: bold">${ val.Debit != null ? AutoNumeric.format(val.Debit, 2) : '0.00'}</td>
            <td class="text-success" style="font-weight: bold">${val.Credit != null ? AutoNumeric.format(val.Credit, 2) : '0.00'}</td>
            <td>${val.Narration}</td>
          </tr>
        `); 
      }); 
    });
    $('.bill-modal').modal();

    // $('')
  });
  // });
</script>





<script>
	$('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
</script>
@endpush
