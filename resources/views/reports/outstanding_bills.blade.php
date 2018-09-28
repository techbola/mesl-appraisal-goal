@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush

@section('title')
  Outstanding Bills
@endsection

@section('page-title')
  Outstanding Bills
@endsection

@section('buttons')
  
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <h3>Outstanding Bills</h3>
  			<table class="table table-bordered tableWithSearch2">
          <thead>
            <th>Action</th>
            <th>Ref</th>
            <th>Customer</th>
            <th>Product Type</th>
            <th>Bill Amount</th>
            <th>Amount Paid</th>
            <th>Amount Oustanding</th>
            
          </thead>
          <tbody>
            @foreach($outstanding_bills as $out_bill)
              <tr>
                <td><a href="#" data-bill="{{ $out_bill->GroupID }}" class="btn btn-sm btn-complete bill-modal-trigger">View Bill</a></td>
                <td>{{ $out_bill->GroupID }}</td>
                <td>{{ $out_bill->Customer }}</td>
                <td>{{ $out_bill->Produt_ServiceType }}</td>
                <td>{{ number_format($out_bill->BillAmount, 2) }}</td>
                <td>{{ number_format($out_bill->AmountPaid, 2) }}</td>
                <td>{{ number_format($out_bill->AmountOS, 2) }}</td>
              </tr>
            @endforeach
          </tbody>   
          <tfoot>
            <tr>
              <td colspan="6" class="text-right text-danger">TOTAL</td>
              <td>{{ number_format($outstanding_bills->sum('AmountOS'), 2) }}</td>
            </tr>
          </tfoot> 
        </table>
  	</div>
  	<!-- END PANEL -->

    <div class="bill-modal modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Bill for <span class="text-info bill-owner"></span></h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered" id="bill-item-table">
              <thead>
                <th>Ref</th>
                <th>Customer</th>
                <th>Product Type</th>
                <th>Bill Amount</th>
                <th>Amount Paid</th>
                <th>Amount Oustanding</th>
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
<script>
  $('.table').on('click', '.bill-modal-trigger', function(event) {
    event.preventDefault();
    var bill_item = $(this).data('bill');
    // console.log(bill_item);
    $('#bill-item-table tbody').html(' ');
    $.post('/get-outstanding-bill-details', {bill_code: bill_item}, function(data, textStatus, xhr) {
      console.log(data.data);
      $('.bill-owner').html(data.data[0].Customer);
      var bill_modal_body = $.each(data.data, function(index, val) {
        $('#bill-item-table tbody').append(` <tr>
            <td>${val.GroupID}</td>
            <td>${val.Customer}</td>
            <td>${val.Produt_ServiceType}</td>
            <td>${AutoNumeric.format(val.BillAmount, 2)}</td>
            <td>${AutoNumeric.format(val.AmountPaid, 2)}</td>
            <td>${AutoNumeric.format(val.AmountOS, 2)}</td>
          </tr>
        `); 
      }); 
    });
    $('.bill-modal').modal();
    // $('')
  });
</script>
@endpush
