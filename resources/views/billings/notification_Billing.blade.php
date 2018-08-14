@extends('layouts.master')

@push('styles')
    <style>
        .modal.fade.fill-in.in {
    background-color: rgba(121, 120, 120, 0.85);
}
    </style>
@endpush

@section('title')
  Create Bill
@endsection

@section('page-title')
  Create Bill
@endsection

@section('buttons')
 
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Create New bill for <span class="text-info">{{ $client_details->Customer }}</span></div><div class="clearfix"></div>
        <div class="row">

          <div class="col-md-7">
              @if(count($bill_items) > 0)
                  <p>
                      <a href="{{ route('Bill', [$client_details->CustomerRef, $code]) }}" class="btn btn-success btn-sm pull-right" title="">Print Bill</a>
                  </p>
              @endif
            <div style="background: #eee; padding: 5px;">
                <h5 style="margin-left: 10px">Product list</h5><hr>
                @if($bill_narration->count() >= 1)
                 <a href="#" class="btn btn-sm btn-warning pull-right hide" id="edit_bill_narration" data-target="#BillNarration" data-toggle="modal" id="btnFillSizeToggler2">Edit Narration to bill</a>
                @else
                <a href="#" class="btn btn-sm btn-info pull-right" id="bill_narration" data-target="#BillNarration" data-toggle="modal" id="btnFillSizeToggler2">Add Narration to bill</a>
                @endif
               
                             <table class="table table-hover">
                                 <thead>
                                     <tr>
                                         <th>Date</th>
                                         <th>Payment Plan</th>
                                         <th>Option</th>
                                         <th>Product</th>
                                         <th>Price</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($bill_items as $bill_item)
                                     <tr>
                                        <td>{{ $bill_item->BillingDate }}</td>
                                        <td>{{ $bill_item->PlanName }}</td>
                                        <td>{{ $bill_item->PlanOption }}</td>
                                        <td>{{ $bill_item->Produt_ServiceType }}</td>
                                        <td>&#8358;{{ number_format($bill_item->Price,2) }}</td>
                                        @if($bill_item->BillingDate < $date)
                                        <td><i class="fa fa-lock" style="font-size: 20px; color: #009688" ></i></td>
                                        @else
                                        <td><a href="#" data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2"
                      data-id="{{ $bill_item->BillingID }}"  data-code="{{ $bill_item->GroupID }}" data-productservice="{{ $bill_item->Produt_ServiceType }}" data-price="{{ $bill_item->Price }}" data-amount="{{ $bill_item->AmountPaid }}" data-outstanding="{{ $bill_item->AmountOutstanding }}" data-createdby="{{ $bill_item->UserID }}" data-unitprice="{{ $bill_item->UnitPrice }}" data-quantity="{{ $bill_item->Quantity }}" data-discount="{{ $bill_item->Discount }}" data-location="{{ $bill_item->LocationID }}"  title=""><i class="fa fa-trash-o" style="font-size: 20px; color: red" ></i></a></td>
                                        @endif
                                     </tr>
                                     @endforeach
                                 </tbody>
                      </table>
                             @if(count($bill_items) > 0)
                             <a href="#" data-target="#modalFillIn2" class="btn btn-lg btn-primary pull-right" data-toggle="modal" id="btnFillSizeToggler2" title="">Pay Now</a><div class="clearfix"></div>
                              @endif
            </div>
          </div>

          <div class="col-md-5">
            <div style="background: #6e7071; padding: 15px; color: #fff">
                             <h5 style="margin-left: 10px; color:#fff">Product Form</h5><hr>
                             {{ Form::open(['action' => 'BillingController@save_bill_item', 'autocomplete' => 'off', 'role' => 'form']) }}
                             <div class="row">
                              <div class="col-sm-12">
                                    <div class="form-group">
                                            {{ Form::label('PlanRef', 'Payment Plan') }}
                                            <select name="PymtID"  class="form-control select2" id="PymtID" onchange="get_plan_option()"  data-init-plugin="select2" required>
                                                <option value="">Select Payment Plan</option>
                                                @foreach($payment_plans as $payment_plan)
                                                    <option value="{{ $payment_plan->PlanRef }}">{{ $payment_plan->PlanName }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>

                                <div class="hide" id="plan_option">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                            {{ Form::label('OptionPlan', 'Payment Option Plan') }}
                                            <select name="OptionID"  class="form-control select2"    data-init-plugin="select2" required>
                                                <option value="">Select Payment Plan</option>
                                                @foreach($options as $option)
                                                    <option value="{{ $option->OptionRef }}">{{ $option->PlanOption }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                              </div>
                                
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
                                            <select name="Produt_ServiceType" id="product" data-init-plugin="select2" class="form-control select2"     required >
                                                <option value=" ">Select Product</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                            {{ Form::label('UnitPrice', 'Unit Price') }}
                                            <input type="text" value="0"  name="UnitPrice" class="form-control" id="unit_price">
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
                                            {{ Form::label('Quantity', 'Quantity') }}
                                            <input type="text" name="Quantity" class="form-control" id="quantity"  value="0" onblur="calculate_total_price()">
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
                                <input type="hidden" id="bill_groupid" name="GroupID" value="{{ $code }}">
                                <input type="hidden" name="ServiceDesc" id="service_desc">
                                <input type="hidden" name="UserID" value="{{ $staff_id->StaffRef }}">
                                {{-- <input type="hidden" name="Produt_ServiceType" id="product_service"> --}}
                                <input type="hidden" id="bill_clientid" name="ClientID" value="{{ $client_details->CustomerRef }}">

                                <div class="pull-right">
                                    <input type="submit" class="btn btn-rounded btn-primary hide" id="add_to_list" value="Add to list">
                                </div>
                             </div>
                             {{ Form::close() }}
                        </div>
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
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #fff">Product Deletion Notification</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-7" style="color: #fff">
                     Please be notified that on click of the button this product will be deleted and please provide reason for deletion in the comment box provided below.
                    </div>
                    <div class="col-md-5 no-padding  ">
                      {{ Form::open(['action' => 'BillingController@productdeletion', 'autocomplete' => 'off', 'role' => 'form']) }}
                      <textarea name="Comment" style="width: 100%;" rows="4" required></textarea>
                      <input type="hidden" name="BillingID" value="" id="getValue">
                      <input type="hidden" name="BillCode" value="" id="getBillCode">
                      <input type="hidden" name="ProductService" value="" id="getProduct">
                      <input type="hidden" name="Price" value="" id="getPrice">
                      <input type="hidden" name="AmountPaid" value="" id="getAmount">
                      <input type="hidden" name="Outstanding" value="" id="getOutstanding">
                      <input type="hidden" name="CreatedByID" value="" id="getCreator">
                      <input type="hidden" name="UnitPrice" value="" id="getUnitPrice">
                      <input type="hidden" name="QuantityBought" value="" id="getQuantity">
                      <input type="hidden" name="Discount" value="" id="getDiscount">
                      <input type="hidden" name="ProductLocation" value="" id="getLocation">
                      <input type="hidden" name="DeletedBy" value="{{ Auth()->user()->staffId }}">
                      <input type="hidden" name="DeletionDate" value="{{ \Carbon\Carbon::now() }}">
                      <input type="submit" class="btn btn-primary btn-lg btn-large fs-15 pull-right" value="Delete Product">
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
  	<!-- END PANEL -->

    <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="BillNarration" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #fff;">Add Narration to Bill.</span></h5>
                </div>
                <div class="modal-body" style="width: 1000px">
                  <div class="row">
                     {{ Form::open(['id' => 'bill_narration_form', 'autocomplete' => 'off', 'role' => 'form']) }}
                    <div class="col-sm-12">
                                      <div class="form-group">
                                          <div class="controls">
                                              {{ Form::textarea('Narration', null, ['class' => 'summernote form-control','rows' => 3, 'placeholder' => 'Be expressive']) }}
                                         </div>
                                      </div>
                                  </div>
                                  <input type="hidden" id="narration_bill_code" name="BillCode">
                                  <input type="hidden" id="narration_bill_clientid" name="ClientID">
                                  <input type="submit" id="submit_bill_narration" class="btn btn-lg btn-info pull-right" value="Submit">
                    {{ Form::close() }}
                  </div>
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
    <!-- END PANEL -->

<div class="page-content-wrapper "> 
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                
                <div class="modal-body" style="background: #eee; color: #000">
                  <div class="modal-header" style="background: #eee; color: #000">
                  <h5 class="text-left p-b-5"><span class="semi-bold">Bill Payment
                </div><hr>
                  <div class="row">
                    <div style="padding: 20px; margin-bottom: 20px">
                      <div class="col-md-12">
                        <span>Customer Name</span>
                        <p  class="text-primary" style="color: #fff; font-weight: 600; font-size: 25px; color: #000" id="customername">{{ $client_details->Customer }}</p>
                      </div><br><br>
                      <div class="col-md-6">
                        <span>Bill Amount</span>
                        <p  class="text-primary" style="color: #fff; font-weight: 600; font-size: 16px; color: #000" id="bill-amt">&#8358;{{ number_format($bill_amount,2) }}</p>
                      </div>
                      <div class="col-md-6">
                        <span>Amount Outstanding</span> 
                     

                        <p  class="text-primary" style="color: #fff; font-weight: 600; font-size: 16px; color: #000" id="bill-os">&#8358;
                            @if(!empty($outstanding[0]->AmountOS))
                            {{ number_format($outstanding[0]->AmountOS, 2) }}
                            @else
                            0.00
                            @endif
                        </p>
                      </div>
                    </div><hr><br>
                    
                    <div class="col-md-12"><hr>
                      {{ Form::open(['action' => 'BillingController@bill_payment', 'autocomplete' => 'off', 'role' => 'form']) }}
                       <div class="col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('GLIDDebit', 'Cash or Bank') }}
                                    <select name="GLIDDebit" id="dropDown" class="full-width" data-init-plugin="select2" required>
                                      <option value="">Select Cash or Bank</option>
                                      @foreach($debit_acct_details as $debit_acct_detail)
                                        <option value="{{ $debit_acct_detail->GLRef }}">{{ $debit_acct_detail->CUST_ACCT }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                               <div class="controls">
                                   <label for="">Amount Paid</label>
                                   <input type="text" id="formattedNumberField" max="{{ $amount_os }}"  name="Amount"  class="form-control" required>
                               </div>
                           </div>
                       </div><div class="clearfix"></div>

                       <div class="col-sm-6">
                         <div class="form-group">
                             <div class="controls">
                                 {{ Form::label('ValueDate', 'Value Date') }}
                                 <div class="input-group date dp">
                                     {{ Form::text('ValueDate', null, ['class' => 'form-control', 'placeholder' => 'Value Date', 'required']) }}
                                     <span class="input-group-addon">
                                         <i class="fa fa-calendar"></i>
                                     </span>
                                 </div>
                              </div>
                         </div>
                     </div>

                       <div class="col-sm-6">
                           <div class="form-group">
                               <div class="controls">
                                   <label for="">Post Date</label>
                                   <input type="text" name="PostDate" id="getvaluedate" value="{{ $configs->TradeDate }}" class="form-control" readonly="">
                               </div>
                           </div>
                       </div>
                       
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('Narration', 'Narration' ) }}
                                        {{ Form::textarea('Narration', $code.': '.$client_details->Customer ,  ['class' => 'form-control', 'placeholder' => 'Enter Narration', 'rows'=>'2']) }}
                                    </div>
                                </div>
                            </div>
                        

                      <input type="hidden" name="StaffID" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="PostingTypeID" value="1">
                      <input type="hidden" name="CurrencyID" value="1">
                      <input type="hidden" name="GLIDCredit" value="{{ $gl->GLRef }}" id="getGLIDDebit">
                      <input type="hidden" name="Reference1" value="{{ $code }}" id="billid">
                      <input type="submit" id="post" class="btn btn-primary btn-lg btn-sm fs-15 pull-right" value="Post">
                      {{ Form::close() }}
                    </div>
                  </div>
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
<script src="{{ asset('assets/js/accounting.js') }}" type="text/javascript"></script>

<script>
    
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var id = $(this).data('id');
            $("#modalFillIn #getValue").val(id);

            var code = $(this).data('code');
            $("#modalFillIn #getBillCode").val(code);

            var product = $(this).data('productservice');
            $("#modalFillIn #getProduct").val(product);

            var price = $(this).data('price');
            $("#modalFillIn #getPrice").val(price);

            var amount = $(this).data('amount');
            $("#modalFillIn #getAmount").val(amount);

            var outstanding = $(this).data('outstanding');
            $("#modalFillIn #getOutstanding").val(outstanding);

            var creator = $(this).data('createdby');
            $("#modalFillIn #getCreator").val(creator);

            var unitprice = $(this).data('unitprice');
            $("#modalFillIn #getUnitPrice").val(unitprice);

            var quantity = $(this).data('quantity');
            $("#modalFillIn #getQuantity").val(quantity);


            var discount = $(this).data('discount');
            $("#modalFillIn #getDiscount").val(discount);

            var location = $(this).data('location');
            $("#modalFillIn #getLocation").val(location);

          });

  </script> 

<script>
  function getProduct()
        {
             var service = $('#category option:selected').text();
            $('#service_desc').val(service);
            var cat_id = $('#category').val();
            $('#product').html('<option value="">Select From Option</option>');
            $.get('/get_newProduct/'+cat_id, function(data, status) {
                $.each(data, function(index, val) {
                    $('#product').append("<option value='"+val.ProductService+"'>" + val.ProductService+' / &#8358;'+accounting.formatNumber(val.Price)+"</option>");
                    $('#product').select2().val(val.ProductService);
                });

            });


        }
    </script>

    <script>
      function calculate_total_price()
      {
        var unit = AutoNumeric.unformat($('#unit_price').val());
        var qty = $('#quantity').val();
        var discount = $('#discount').val();
        var total = unit * qty;
        $('#total').val(total - discount);
        var submit_button = $('#total').val();
        if(submit_button >= 1)
             {
                 $('#add_to_list').removeClass('hide');
             }else
             {
                $('#add_to_list').addClass('hide');
             }
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
             $('#unit_price').val(AutoNumeric.unformat(data.Price));
             $('#total').val(AutoNumeric.unformat(data.Price * 1));
              $('#quantity').val(1); 
             var total = $('#total').val();
             
             if(total >= 1)
             {
                 $('#add_to_list').removeClass('hide');
             }else
             {
                $('#add_to_list').addClass('hide');
             }
         });

       }
    </script>

    <script>
      function get_plan_option()
      {
        var id = $('#PymtID').val();
        if(id == 2)
        {
          $('#plan_option').removeClass('hide');
        }else
        {
          $('#plan_option').addClass('hide');
        }
      }
    </script>

    <script>
      $('#bill_narration').click(function(event) {
        var code = $('#bill_groupid').val();
        var client_id = $('#bill_clientid').val();
        $('#narration_bill_code').val(code);
        $('#narration_bill_clientid').val(client_id);
      });

      $('#submit_bill_narration').click(function(event) {
        $.post('/submit_bill_narration', $('#bill_narration_form').serialize(), function(data, status) {
          if(status == 'success')
          {
            var code = $('#bill_groupid').val();
        var client_id = $('#bill_clientid').val();
           window.location.href = "{{ url('/billings/notification_Billing') }}/" + client_id + '/' + code;
          }
        });

        $('#BillNarration').modal('toggle');
        var form = $('#bill_narration_form')[0]; 
        return false;
      });
    </script>

@endpush


