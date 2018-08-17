@extends('layouts.master')

@section('title')
  Vendors
@endsection

@section('page-title')
  Vendors
@endsection

@section('buttons')
  <button class="btn btn-sm btn-info pull-right" id="add_vendor_button" data-toggle="modal" data-target="#new_project">Add New Vendor</button>
@endsection

@section('content')
 
  <!-- START PANEL -->
  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Search vendors</div>
    </div>
       <div class="row">
        {{ Form::open(['action' => 'VendorController@search_company_vendor', 'autocomplete' => 'off', 'role' => 'form']) }}
               <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('Vendor', 'Enter Vendor' ) }}
                            {{ Form::text('Vendor', null, ['class' => 'form-control', 'placeholder' => 'Enter Vendor', 'required']) }}
                        </div>
                    </div>
                    {{ Form::submit('Search', ['class'=>'btn btn-lg btn-info pull-right']) }}
               </div><br>
               
        {{ Form::close() }}
       </div>    
  </div>
  <!-- END PANEL -->

  <div class="modal fade slide-up" id="new_project" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5 id="title"></h5>
                <div class="modal-body">
                    <div id="bank_account_div">
                         <form id="vendor_form" class="hide">
                            {{ csrf_field() }}
                            @include('company_vendors.vendor_form')
                         </form>
                    </div>

                    <div id="edit_bank_account_div">
                         <form id="edit_vendor_form" class="hide">
                            {{ csrf_field() }}
                            {{-- @include('company_vendors.vendor_edit_form') --}}
                         </form>
                    </div>
                </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
</div>

  
</v-container>


@endsection

@push('scripts')
  <script>
      $('#add_vendor_button').click(function(event) {
          $('#title').html('New Vendor Form');
          $('#vendor_form').removeClass('hide');
      });
  </script>
@endpush
