@extends('layouts.master')

@section('title')
  Vendor
@endsection

@section('page-title')
  Vendor
@endsection

@section('buttons')
   <button class="btn btn-sm btn-info pull-right" id="add_vendor_button" data-toggle="modal" data-target="#new_project">New Vendor</button>
@endsection

@section('content')
 
  <!-- START PANEL -->
  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Search Vendor</div>
    </div>
       <div class="row">
        {{ Form::open(['action' => 'VendorController@search_company_vendor', 'autocomplete' => 'off', 'role' => 'form']) }}
               <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('Vendor', 'Enter Vendor' ) }}
                            {{ Form::text('Vendor', null, ['class' => 'form-control', 'id'=>'vendor', 'placeholder' => 'Enter Vendor', 'required']) }}
                        </div>
                    </div>
                    {{ Form::submit('Search', ['class'=>'btn btn-lg btn-info pull-right']) }}
               </div><br>
               
        {{ Form::close() }}
       </div>    
  </div>
  <!-- END PANEL -->

   <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Vendor</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>

      <table class="table tableWithSearch table-striped table-bordered">
      <thead>
        <th>Vendor</th>
        <th>VendorCode</th>
        <th>CompanyPhone</th>
        <th>ContactName</th>
        <th>ContactPhone</th>
        <th>AddressLine1</th>
        <th>Actions</th>
      </thead>
      <tbody id="bank_account_body">
        @foreach($results as $result)
        <tr>
            <td>{{ $result->Vendor }}</td>
            <td>{{ $result->VendorCode }}</td>
            <td>{{ $result->CompanyPhone }}</td>
            <td>{{ $result->ContactName }}</td>
            <td>{{ $result->ContactPhone }}</td>
            <td>{{ $result->AddressLine1 }}</td>
              <td class="actions">
                  <a href="#" data-id="{{ $result->VendorRef }}" data-pat="{{ $result->Vendor }}"  data-target="#modalFillIn"  data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-xs btn-success"><i class="fa fa-cc-mastercard"></i>  Create Bill</a>
                  <a href="{{ route('View_Vendor_Bill_List',[$result->VendorRef]) }}" data-toggle="tooltip" data-placement="top" title="View Bill(s)" class="btn btn-xs btn-warning"><i class="fa fa-clipboard">View bill</i></a>
                  <a href="{{ route('Client_Document_List',[$result->VendorRef]) }}" data-toggle="tooltip" data-placement="top" title="Documents" title="" class="btn btn-xs btn-info"><i class="fa fa-file-text-o"></i>  Documents</a>
                  {{-- <a href="#" data-toggle="modal" data-target="#details" class="btn btn-inverse btn-xs" onclick="customer_details({{ $result->VendorRef }})">Details</a> --}}
                  <a href="#" data-toggle="modal" data-target="#edit_client_form" class="btn btn-primary btn-xs" onclick="vendor_edit_details({{ $result->VendorRef }})">Edit Details</a>
                  {{-- <a href="{{ route('facility-management.complaints.show',[$result->VendorRef]) }}" title="" class="btn btn-xs btn-primary"><i class="fa fa-file-text-o"></i> Fix My House</a> --}}
                </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    
  </div>
  <div class="modal fade slide-up" id="new_project" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5 id="title"></h5>
                <div class="modal-body">
                    <div id="vendor_div"  class="hide">
                         <form id="vendor_form">
                            {{ csrf_field() }}
                            @include('company_vendors.vendor_form')
                            <button type="submit" id="submit_vendor" class="btn btn-info btn-form pull-right">Submit</button>
                         </form>
                    </div>

                    <div id="edit_vendor_div" class="hide">
                         <form id="edit_vendor_form">
                            {{ csrf_field() }}
                            {{-- @include('bank_account.bank_account_edit_form') --}}

                         </form>
                    </div>
                </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
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
                <div style="background: #fff">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000">New Bill Notification</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-9" style="color: #000">
                     A new bill will be created for <span style="font-weight: 800" id="pat_name"></span> on Click of the button
                    </div><hr>
                    <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                      {{ Form::open(['action' => 'VendorController@new_bill', 'autocomplete' => 'off', 'role' => 'form']) }}
                            <input type="hidden" name="vendor_id" id="getValue">
                            <input type="submit" class="btn btn-sm btn-info" value="Create New Bill">
                      {{ Form::close() }}
                      {{-- <a href="{{ route('NotificationBilling',[$customerDetails->PatientRef]) }}" class="btn btn-primary btn-lg btn-large fs-15" title="">Create Bill</a> --}}
                    </div>
                  </div>
                  <p class="text-right sm-text-center hinted-text p-t-10 p-r-10" style="color: red">Please be sure of the bill before creating and avoid duplicating bill.</p>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

            <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="edit_client_form" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 900px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000">Edit Vendor Details</span></h5>
                </div>
                <div class="modal-body">
                  {{ Form::open(['id' => 'xyz', 'autocomplete' => 'off', 'role' => 'form']) }}
                    
                    {{ csrf_field() }}
                    @include('company_vendors.vendor_form')
                    <input type="hidden" name="VendorRef">

                     <button type="submit" id="submit_edit_vendor" class="btn btn-info btn-form pull-right">Submit</button>

                  {{ Form::close() }}
                </div>
                <div class="modal-footer">
                </div>
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
      $('#add_vendor_button').click(function(event) {
          $('#title').html('New Vendor Form');
          $('#vendor_div').removeClass('hide');
          $('#edit_vendor_div').addClass('hide');
      });

    
  </script>

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
    function vendor_edit_details(id)
    {
      var ref = id;
      $.get('/get_vendor_details_onrequest/' +ref, function(data, status) {
        if(status == 'success')
        {
          console.log(data);
          $('#edit_client_form [name="Vendor"]').val(data.Vendor);
          $('#edit_client_form [name="VendorRef"]').val(data.VendorRef);
          $('#edit_client_form [name=CompanyPhone]').val(data.CompanyPhone);
          $('#edit_client_form [name=CompanyName]').val(data.CompanyName);
          $('#edit_client_form [name=ContactPhone]').val(data.ContactPhone);
          $('#edit_client_form [name=AddressLine1]').val(data.AddressLine1);
          $('#edit_client_form [name=AddressLine2]').val(data.AddressLine2);
          $('#edit_client_form [name=AddressLine3]').val(data.AddressLine3);
          
        }
      });
    }
  </script>

   <script>
      $('#submit_edit_vendor').click(function(event) {
        event.preventDefault();
        $.post('/submit_edited_vendor_data', $('#xyz').serialize(), function(data, status) {
          if (status == 'success') 
          {
            $('#edit_client_form').modal('toggle');
            window.location = '{{ route('SearchVendors') }}';
          }
        });
      });
  </script>

@endpush



