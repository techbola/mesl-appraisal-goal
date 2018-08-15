@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush

@section('title')
  Search for Client(s)
@endsection

@section('page-title')
  Search for Client(s)
@endsection

@section('buttons')
  <a href="#" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2"  class="btn btn-info btn-rounded pull-right" >Add New Client</a> &nbsp &nbsp
   <a href="#" data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler3"  class="btn btn-success btn-rounded pull-right" >Add New Product or Service</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Search for Client(s)</div><div class="clearfix"></div>
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
        </div>
  	</div>
  	<!-- END PANEL -->


      <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog">
              <div class="modal-content">
                <div style="background: #fff; width: 900px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000">Add New Client</span></h5>
                </div>
                <div class="modal-body">
                    {{ Form::open(['action' => 'ClientController@store', 'autocomplete' => 'off', 'role' => 'form']) }}
                      @include('billings.client_form')
                    {{ Form::close() }}
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
          <div class="modal fade fill-in" id="modalFillIn3" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000">Add New Product or Service</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">

                      {{ Form::open(['action' => 'ProductServiceController@store', 'autocomplete' => 'off', 'role' => 'form']) }}

                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Product Category' ) }}
                                              {{ Form::select('CategoryID', [ '' =>  'Select Product Category'] + $product_categories->pluck('ProductCategory', 'ProductCategoryRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Product Category", 'data-init-plugin' => "select2", 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Product Service' ) }}
                                               {{ Form::text('ProductService', null, ['class' => 'form-control', 'placeholder' => 'Product Service', 'required']) }}
                                       </div>
                                  </div>
                              </div>
                              <div class="clearfix"></div>

                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Location' ) }}
                                               {{ Form::select('LocationID', [ '' =>  'Select Location'] + $locations->pluck('Location', 'LocationRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Location", 'data-init-plugin' => "select2", 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Price' ) }}
                                               {{ Form::text('Price', null, ['class' => 'form-control', 'placeholder' => 'Price', 'required']) }}
                                       </div>
                                  </div>
                              </div>
                            <input type="submit" class="btn btn-sm btn-info pull-right" value="Add Product or Service">
                      {{ Form::close() }}
                  </div>
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
@endpush
