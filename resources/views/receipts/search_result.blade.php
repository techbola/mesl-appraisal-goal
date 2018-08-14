@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush

@section('title')
  Search Result
@endsection

@section('page-title')
  Search Result
@endsection 

@section('buttons')
   

@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">

      <div class="card-title pull-left">Search for Result</div><div class="clearfix"></div>
        <div class="row">
          {{ Form::open(['action' => 'BillingController@client_search_receipt', 'autocomplete' => 'off', 'role' => 'form']) }}
          <div class="col-md-6 col-md-offset-3">
                 <div class="form-group">
                   {{ Form::label('client_name', 'Client Name' ) }}
                     {{ Form::text('client_name', null, ['class' => 'form-control', 'placeholder' => 'Client Name...', 'required']) }}
                   </div>

                   <div class="pull-right">
                     {{ Form::submit('Search', ['class' => 'btn btn-sm btn-info']) }}
                   </div>
          </div>
          {{ Form::close() }}
        </div><br>


        <div class="">
          <div class="pull-right">
          <div class="col-xs-12">
            <input type="text" class="search-table form-control pull-right" placeholder="Search">
          </div>
        </div>
          <table class="table tableWithSearch table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Estate</th>
                <th>Block</th>
                <th>Unit</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($results as $result)
              <tr>
                <td>{{ $result->Customer }}</td>
                <td>{{ $result->Email }}</td>
                <td>{{ $result->Address }}</td>
                <td>{{ $result->estate_allocation->estate->ProjectName ?? '' }}</td>
                <td>{{ $result->estate_allocation->Block ?? '' }}</td>
                <td>{{ $result->estate_allocation->Unit ?? '' }}</td>
                <td class="actions">
                  
                  <a href="{{ route('view_receipt_list', $result->CustomerRef) }}"  class="btn btn-primary btn-xs">View Receipts</a>
                  
                  <a href="{{ route('View_Client_Bill_List',[$result->CustomerRef]) }}" data-toggle="tooltip" data-placement="top" title="View Bill(s)" class="btn btn-xs btn-warning"><i class="fa fa-clipboard">View bill</i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  	</div>
  	<!-- END PANEL -->




@endsection

@push('scripts')
    <script>
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var id = $(this).data('id');
            $("#modalFillIn #getValue").val(id);

            var pat = $(this).data('pat');
            $("#modalFillIn #pat_name").html(pat);
          });
  </script>

  <script>
    function customer_details(id) {
      $.get('/get_customer/'+id, function(customer, status){
        $('#details .modal-body').html(`

          <ul class="my-list">
            <li><b>Name:</b> ${customer.Customer}</li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
          </ul>
        `);
      });
    }
  </script>

  <script>
    function customer_edit_details(id)
    {
      var ref = id;
      $.get('/get_client_details_onrequest/' +ref, function(data, status) {
        if(status == 'success')
        {
          console.log(data);
          $('#edit_client_form #edit_FileNo').val(data.FileNo);
          $('#edit_client_form #edit_Customer').val(data.Customer);
          $('select[name="HouseType"]').val(data.HouseType).trigger('change');
          $('#edit_BlockAllocation').val(data.BlockAllocation);
          $('#edit_UnitAllocation').val(data.UnitAllocation);
          $('#edit_Phone').val(data.Phone);
          $('#edit_Email').val(data.Email);
          $('select[name="TitleID"]').val(data.TitleID).trigger('change');
          $('select[name="GenderID"]').val(data.GenderID).trigger('change');
          $('select[name="NationalityID"]').val(data.NationalityID).trigger('change');
          $('select[name="MaritalStatusID"]').val(data.MaritalStatusID).trigger('change');
          $('select[name="AccountMgrID"]').val(data.AccountMgrID).trigger('change');
          $('select[name="PaymentPlanID"]').val(data.PaymentPlanID).trigger('change');
          $('#edit_EnrollmentDate').val(data.EnrollmentDate);
          $('#edit_PropertyCost').val(data.PropertyCost);
          $('#edit_AmountPaid').val(data.AmountPaid);
          $('#edit_AmountOutstanding').val(data.AmountOutstanding);
          $('#edit_PropertyReference').val(data.PropertyReference);
          $('#edit_DeliveryPeriod').val(data.DeliveryPeriod);
          $('#edit_HouseUnitStatus').val(data.HouseUnitStatus);
          $('#edit_DefaultPeriod').val(data.DefaultPeriod);
          $('#edit_Address').val(data.Address);
          $('#edit_DateOfBirth').val(data.DateOfBirth);
          $('#edit_NextOfKIN').val(data.NextOfKIN);
          $('#edit_Employer').val(data.Employer);
          $('#edit_Industry').val(data.Industry);
          $('#edit_ContactSource').val(data.ContactSource);
          $('#edit_Remarks').val(data.Remarks);
          $('#edit_CustomerRef').val(data.CustomerRef);
        }
      });
    }
  </script>

@endpush
