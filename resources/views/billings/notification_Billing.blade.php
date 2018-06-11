@extends('layouts.master')
@section('title')
  Create Bill
@endsection

@section('page-title')
  Create Bill
@endsection

@section('buttons')
 {{--  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Add New Client</a> &nbsp &nbsp
  <a href="{{ route('LeaveRequest') }}" class="btn btn-success btn-rounded pull-right" >Add New Product or Service</a> --}}
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Create New bill for <span class="text-info">{{ $client_details->Name }}</span></div><div class="clearfix"></div>
        <div class="row">

          <div class="col-md-7">
              @if(count($bill_items) > 0)
                  <p>
                      <a href="{{ route('Bill', [$client_details->ClientRef, $code]) }}" class="btn btn-success btn-sm pull-right" title="">Print Bill</a>
                  </p>
              @endif
            <div style="background: #eee; padding: 5px;">
                <h5 style="margin-left: 10px">Product list</h5><hr>
                             <table class="table table-hover">
                                 <thead>
                                     <tr>
                                         <th>Date</th>
                                         <th>Category</th>
                                         <th>Product</th>
                                         {{-- <th>Quantity</th> --}}
                                         <th>Price</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($bill_items as $bill_item)
                                     <tr>
                                        <td>{{ $bill_item->BillingDate }}</td>
                                        <td>{{ $bill_item->ServiceDesc }}</td>
                                        <td>{{ $bill_item->Produt_ServiceType }}</td>
                                        {{-- <td>{{ $bill_item->Quantity }}</td> --}}
                                        <td>&#8358;{{ number_format($bill_item->Price,2) }}</td>
                                        <td><i class="fa fa-trash-o" style="font-size: 20px; color: red" ></i></td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                            {{--  @if(count($productLists) > 0)
                             <a href="#" data-target="#modalFillIn2" class="btn btn-lg btn-primary pull-right" data-toggle="modal" id="btnFillSizeToggler2" title="">Pay Now</a><div class="clearfix"></div>
                              @endif --}}
            </div>
          </div>

          <div class="col-md-5">
            <div style="background: #2196f3; padding: 15px;">
                             <h5 style="margin-left: 10px">Product Form</h5><hr>
                             {{ Form::open(['action' => 'BillingController@save_bill_item', 'autocomplete' => 'off', 'role' => 'form']) }}
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                            {{ Form::label('Surname', 'Category') }}
                                            <select name="CategoryID" id="category" class="form-control select2"    data-init-plugin="select2" required onchange="getProduct()">
                                                <option value="">Select Category</option>
                                                @foreach($product_categories as $product_category)
                                                    <option value="{{ $product_category->ProductCategoryRef }}">{{ $product_category->ProductCategory }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                               
                                <div class="col-sm-12">
                                    <div class="form-group">
                                            {{ Form::label('Product') }}
                                            <select name="Product" id="product" data-init-plugin="select2" class="form-control select2"     required onchange="getPrice()">
                                                <option value="0">Select Product</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                            {{ Form::label('UnitPrice', 'Unit Price') }}
                                            <input type="text" name="UnitPrice" class="form-control" id="unit_price" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                            {{ Form::label('Quantity', 'Quantity') }}
                                            <input type="text" name="Quantity" class="form-control" id="quantity"  value="0" onkeyup="getTotalPrice()">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                            {{ Form::label('Discount', 'Product Discount') }}
                                            <input type="number" name="Discount" id="discount" class="form-control" value="0.00" onkeyup="get_new_total_price()">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                            {{ Form::label('TotalPrice', 'Total Price') }}
                                            <input type="text" name="TotalPrice" class="form-control" id="total" readonly required>
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="LocationID" value="{{ $location_id }}"> --}}
                                <input type="hidden" name="StaffRef" value="{{ $staff_id->StaffRef }}">
                                <input type="hidden" name="InvItemID" id="InvItemID">
                                {{-- <input type="hidden" name="PatientRef" value="{{ $patientRef }}"> --}}
                                <input type="hidden" name="GroupID" value="{{ $code }}">
                                <input type="hidden" name="ServiceDesc" id="service_desc">
                                <input type="hidden" name="UserID" value="{{ $staff_id->StaffRef }}">
                                <input type="hidden" name="Produt_ServiceType" id="product_service">
                                <input type="hidden" name="ClientID" value="{{ $client_details->ClientRef }}">
                                <div class="pull-right">
                                    <input type="submit" class="btn btn-rounded btn-primary" value="Add to list">
                                </div>
                             </div>
                             {{ Form::close() }}
                        </div>
          </div>

        </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/accounting.js') }}" type="text/javascript"></script>
<script>
  function getProduct()
        {
             var service = $('#category option:selected').text();
            $('#service_desc').val(service);
            var cat_id = $('#category').val();
            $('#product').html(' ');
            $.get('/get_newProduct/'+cat_id, function(data, status) {
                $.each(data, function(index, val) {
                    $('#product').append("<option value='"+val.ProductServiceRef+"'>" + val.ProductService+' / &#8358;'+accounting.formatNumber(val.Price)+"</option>");
                });

            });


        }
    </script>

    <script>
       function getPrice()
       {
         var prod_id = $('#product').val();
         var productname = $('#product option:selected').text();
         $('#InvItemID').val(prod_id);
         $('#product_service').val(productname);
         $.get('/get_new_product_price/'+prod_id, function(data, status) {
             $('#unit_price').val(data.Price);
             $('#total').val(data.Price * 1);
         });
             $('#quantity').val(1);        
       }
    </script>

@endpush


