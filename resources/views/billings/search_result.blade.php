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
  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Add New Client</a> &nbsp &nbsp
  <a href="{{ route('LeaveRequest') }}" class="btn btn-success btn-rounded pull-right" >Add New Product or Service</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">

      <div class="card-title pull-left">Search for Result</div><div class="clearfix"></div>
        <div class="row">
          {{ Form::open(['action' => 'BillingController@client_search', 'autocomplete' => 'off', 'role' => 'form']) }}
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


        <div class="row">
          <div class="pull-right">
          <div class="col-xs-12">
            <input type="text" class="search-table form-control pull-right" placeholder="Search">
          </div>
        </div>
          <table class="table tableWithSearch table-bordered">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th width="30%">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($results as $result)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $result->Name }}</td>
                <td>{{ $result->Email }}</td>
                <td>{{ $result->Phone }}</td>
                <td>{{ $result->Address }}</td>
                <td>
                  <a href="#" data-id="{{ $result->ClientRef }}" data-pat="{{ $result->Name }}"  data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-xs btn-success"><i class="fa fa-cc-mastercard"></i>  Create Bill</a>
                  <a href="{{ route('View_Client_Bill_List',[$result->ClientRef]) }}" title="" class="btn btn-xs btn-warning"><i class="fa fa-clipboard"></i>  view Bill(s)</a>
                  <a href="{{ route('Client_Document_List',[$result->ClientRef]) }}" title="" class="btn btn-xs btn-info"><i class="fa fa-file-text-o"></i>  Documents</a>
                  <a href="{{ route('estate-management.complaints.show',[$result->ClientRef]) }}" title="" class="btn btn-xs btn-info"><i class="fa fa-file-text-o"></i>  Documents</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  	</div>
  	<!-- END PANEL -->

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
                    </div>
                    <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                      {{ Form::open(['action' => 'BillingController@new_bill', 'autocomplete' => 'off', 'role' => 'form']) }}
                            <input type="hidden" name="client_id" id="getValue">
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

@endpush

