@extends('layouts.master')
@push('styles')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css" media="screen">
</style>
@endpush
@section('content')
<div class="card-box">
	<div class="panel-heading">
		<div>
			<h3>Search For Product & Services</h3>
		</div>
	</div><hr>
	<div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        
      </div>
      <div class="col-md-6">
        <div class="alert alert-success" style="display: none;" id="success_msg" role="alert">
        </div>
        <div class="alert alert-danger" style="display: none;" id="error_msg" role="alert">
        </div>
      </div>
    </div>

		<div class="row">
        <div class="col-md-4">
          <div style="padding: 20px; background: #eee">
            <div class="row">
              <div class="col-md-6">
                <a href="" class="btn btn-sm btn-warning" id="add_category" data-target="#modalFillIn" data-toggle="modal">New Category</a>
              </div>
              {{-- <div class="col-md-4">
                <a href="" class="btn btn-sm btn-success" id="add_title" data-target="#modalFillIn" data-toggle="modal">New Product</a>
              </div> --}}
              <div class="col-md-6">
                <a href="" class="btn btn-sm btn-info" id="add_price" data-target="#modalFillIn" data-toggle="modal">New Product & Services</a>
              </div>
            </div><hr>
              <div class="row">
                {{ Form::open(['id' =>'search_form', 'autocomplete' => 'off',  'role' => 'form']) }}
                      <div class="col-sm-12">
                          <div class="form-group">
                              {{ Form::label('Category', 'category') }}
                                 <select name="CategoryID" class="form-control select2" data-init-plugin="select2" required>
                                  <option>Select category</option>
                                   @foreach($categories as $category)
                                       <option value="{{ $category->ProductCategoryRef }}">{{ $category->ProductCategory }}</option>
                                   @endforeach
                                 </select>
                          </div>
                      </div>

                      <div class="col-sm-12">
                          <div class="form-group">
                              {{ Form::label('Location', 'Location') }}
                                 <select name="LocationID"  class="form-control select2" data-init-plugin="select2" required>
                                  <option>Select Location</option>
                                   @foreach($locations as $location)
                                       <option value="{{ $location->LocationRef }}">{{ $location->Location }}</option>
                                   @endforeach
                                 </select>
                          </div>
                      </div>

                      <div>
                        <button type="submit" class="btn btn-sm btn-primary pull-right" id="submit_search">Search</button>
                      </div>
                {{ Form::close() }}<div class="clearfix"></div>
              </div>
          </div>
        </div>  

        <div class="col-md-8">
          <div style="padding: 20px; background: #eee">
            <table class="table table-hover sample" id="example">
              <thead>
                  <th style="color: #000 !important">Category</th>
                  <th style="color: #000 !important">Product/Service</th>
                  <th style="color: #000 !important">ProductCode</th>
                  <th></th>
              </thead><br>
              <tbody id="search_body">
              </tbody>
            </table>
          </div>
        </div>
    </div>

	</div>
</div>


<!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="modalFillIn"  role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5 id="title"></h5><hr>
          </div>
          <div class="modal-body">
                  <div class="hide" id="add_product_div">
                    @include('errors.list')
                    {{ Form::open(['id' => 'add_product_form', 'autocomplete' => 'off','role' => 'form']) }}
                      @include('product_service.add_product')
                    {{ Form::close() }}
                  </div>
                  <div class="hide" id="add_category_div">
                    {{ Form::open(['id' => 'add_category_form', 'autocomplete' => 'off','role' => 'form']) }}
                      @include('product_service.add_category')
                    {{ Form::close() }}
                  </div>
                  <div class="hide" id="add_price_div">
                    @include('errors.list')
                    {{ Form::open(['id' => 'add_product_price_form', 'autocomplete' => 'off','role' => 'form']) }}
                      @include('product_service.add_product_services')
                    {{ Form::close() }}
                  </div>
                  <div class="hide" id="edit_price_div">
                    @include('errors.list')
                    {{ Form::open(['id' => 'edit_product_form', 'autocomplete' => 'off','role' => 'form']) }}
                      @include('product_service.edit_product_form')
                    {{ Form::close() }}
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" type="text/javascript" ></script>
  <script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
        }
    });
    

    $(function() {
      $('#submit_search').click(function(e) {
     e.preventDefault();
     var that = $(this);

     var table = $("#example").DataTable({
         dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>> <'table-responsive 't> p",
            'ajax': {
    "type"   : "POST",
    "url"    : '/get_product_and_service',
    "data"   : function( d ) {
        d.CategoryID= $('[name=CategoryID]').val();
        d.LocationID= $('[name=LocationID]').val();
    },
  },
          "columns": [
            { "data": "ProductCategory" },
            { "data": "ProductService" },
            { "data": "ProductCode" },
            { "data": "ProductServiceRef" }
        ],
        'columnDefs': [
          {
            'targets': 3,
            'createdCell':  function(td, cellData, rowData, row, col){
              // console.log(rowData);
              $(td).html(`<button onclick="get_edit_details(${rowData.ProductServiceRef})" data-target="#modalFillIn" data-toggle="modal" id="edit_pro" class="btn btn-sm btn-primary">Edit Product</button>`);

            }
          }
        ],
        destroy: true,
        "scrollCollapse": true,
            "oLanguage": {
                "sSearch": "", 
                "sSearchPlaceholder": "Search",
                "sLengthMenu": "_MENU_ "
            },
            "iDisplayLength": 10,
            fnDrawCallback: function(oSettings) {
                $('.export-options-container').append($('.exportOptions'));
            }

});
     table.ajax.reload();

     
 });


    });
    
  </script>

  <script>
    function get_edit_details(id)
    {
     $('#add_category_div').addClass('hide');
      $('#edit_price_div').removeClass('hide');
      $('#add_price_div').addClass('hide');
      $('#add_product_div').addClass('hide');
       $('#title').html('Edit Product & Services');

      $.get('/product_service_editproduct/'+id, function(data, status) {
         $('#product_Code').val(data.ProductCode);
         $('select[name="CategoryID"]').val(data.CategoryID).trigger('change');
         $('select[name="LocationID"]').val(data.LocationID).trigger('change');
         $('#product_name').val(data.ProductService);
         $('#product_ref').val(data.ProductServiceRef);

      });
    }

    $('#add_title').click(function(event) {
      $('#add_category_div').addClass('hide');
      $('#edit_price_div').addClass('hide');
      $('#add_price_div').addClass('hide');
      $('#add_product_div').removeClass('hide');
      $('#title').html('Add New Product'); 
    });

     $('#add_category').click(function(event) {
      $('#add_category_div').removeClass('hide');
      $('#edit_price_div').addClass('hide');
      $('#add_price_div').addClass('hide');
      $('#add_product_div').addClass('hide');
       $('#title').html('Add New Product Category'); 
    });

      $('#add_price').click(function(event) {
      $('#add_category_div').addClass('hide');
      $('#edit_price_div').addClass('hide');
      $('#add_price_div').removeClass('hide');
      $('#add_product_div').addClass('hide');
       $('#title').html('Add New Product & Services'); 
    });



    $('#submit_new_product').click(function(event) {
       event.preventDefault();
                    var button = $('#submit_new_product');
                    $.ajax({
                      url: '/post_new_product',
                      type: 'POST',
                      data: $('#add_product_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Saving...</p>');
                    }
                    })
                    .done(function(data, status) {
                          $('#success_msg').html(' ');
                              $('#success_msg').show();
                              $('#success_msg').append(`
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Success: </strong>Product Saved Successfully.
                              </div>
                            `);

                    })
                    .fail(function() {
                      $('#error_msg').html(' ');
                         $('#error_msg').show();
                         $('#error_msg').append(`
                           <button class="close" data-dismiss="alert"></button>
                           <strong>Error: </strong>Product cannot be Saved, Please ensure data are inputted correctly.
                         </div>
                           `);
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit");
                       $("#add_product_form")[0].reset();
                       $('#modalFillIn').modal('toggle');
                       $('#success_msg').fadeOut( 7000, "linear");
                       $('#error_msg').fadeOut( 7000, "linear");
                       });
    });

    $('#submit_new_product_service').click(function(event) {
       event.preventDefault();
                    var button = $('#submit_new_product_service');
                    $.ajax({
                      url: '/post_new_product_service',
                      type: 'POST',
                      data: $('#add_product_price_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Saving...</p>');
                    }
                    })
                    .done(function(data, status) {
                          $('#success_msg').html(' ');
                              $('#success_msg').show();
                              $('#success_msg').append(`
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Success: </strong>Product Saved Successfully.
                              </div>
                            `);

                    })
                    .fail(function() {
                      $('#error_msg').html(' ');
                         $('#error_msg').show();
                         $('#error_msg').append(`
                           <button class="close" data-dismiss="alert"></button>
                           <strong>Error: </strong>Product cannot be Saved, Please ensure data are inputted correctly.
                         </div>
                           `);
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit");
                       $("#add_product_price_form")[0].reset();
                       $('#modalFillIn').modal('toggle');
                       $('#success_msg').fadeOut( 7000, "linear");
                       $('#error_msg').fadeOut( 7000, "linear");
                       });
    });

     $('#submit_new_category').click(function(event) {
       event.preventDefault();
                    var button = $('#submit_new_category');
                    $.ajax({
                      url: '/post_new_category',
                      type: 'POST',
                      data: $('#add_category_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Saving...</p>');
                    }
                    })
                    .done(function(data, status) {
                          $('#success_msg').html(' ');
                              $('#success_msg').show();
                              $('#success_msg').append(`
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Success: </strong>Category Saved Successfully.
                              </div>
                            `);

                    })
                    .fail(function() {
                      $('#error_msg').html(' ');
                         $('#error_msg').show();
                         $('#error_msg').append(`
                           <button class="close" data-dismiss="alert"></button>
                           <strong>Error: </strong>Category cannot be Saved, Please ensure data are inputted correctly.
                         </div>
                           `);
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit");
                       $("#add_category_form")[0].reset();
                       $('#modalFillIn').modal('toggle');
                       $('#success_msg').fadeOut( 7000, "linear");
                       $('#error_msg').fadeOut( 7000, "linear");
                       });
    });

    $('#submit_edit_product_service').click(function(event) {
      event.preventDefault();
      var button = $('#submit_edit_product_service');
                    $.ajax({
                      url: '/post_edited_product',
                      type: 'POST',
                      data: $('#edit_product_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Updating...</p>');
                    }
                    })
                    .done(function(data, status) {
                          $('#success_msg').html(' ');
                              $('#success_msg').show();
                              $('#success_msg').append(`
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Success: </strong>Product Updated Successfully.
                              </div>
                            `);

                              location.reload();

                    })
                    .fail(function() {
                      $('#error_msg').html(' ');
                         $('#error_msg').show();
                         $('#error_msg').append(`
                           <button class="close" data-dismiss="alert"></button>
                           <strong>Error: </strong>Product cannot be updated, Please ensure data are inputted correctly.
                         </div>
                           `);
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit");
                       $('#modalFillIn').modal('toggle');
                       $('#success_msg').fadeOut( 7000, "linear");
                       $('#error_msg').fadeOut( 7000, "linear");
                       });
    });

   
  </script>



@endpush

