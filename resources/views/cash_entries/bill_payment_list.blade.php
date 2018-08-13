@extends('layouts.master')
@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
<style>
    .modal.fade.fill-in.in {
    background-color: rgba(0, 0, 0, 0.63);
}
</style>
@endpush
@section('content')
<div class="panel panel-default">
	<div class="panel-body">
		<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-Branch">
			<h2>Bill Payment</h2>
			</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table tableWithSearch">
				<thead>
					<th style="font-weight: 600; color: #000">Bill Code</th>
					<th style="font-weight: 600; color: #000">Customer name</th>
					<th style="font-weight: 600; color: #000">Bill Amount</th>
					<th style="font-weight: 600; color: #000">Amount Paid</th>
					<th style="font-weight: 600; color: #000">Amount Outstanding</th>
          <th style="font-weight: 600; color: #000">Staff Name</th>
				</thead>
				<tbody>
					@foreach($paymentlists as $paymentlist)
            @if($paymentlist->AmountOS > 0.00)
						<tr>
							<td style="font-weight: 500; color: #000"><a href="#" class="btn btn-lg btn-primary" data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2"
                      data-billid="{{ $paymentlist->BillID }}" data-debit="{{ $debit_acct_details}}" data-valuedate="{{ $configs->TradeDate}}"  data-customer="{{ $paymentlist->Customer }}" data-billamount="{{ $paymentlist->BillAmount }}" data-amountpaid="{{ $paymentlist->AmountPaid }}" data-amountos="{{ $paymentlist->AmountOS }}"  data-gliddebit="{{ $paymentlist->GLIDDebit }}  "  title="">{{ $paymentlist->BillID }}</a></td>
							<td style="font-weight: 500; color: #000">{{ $paymentlist->Customer }}</td>
							<td style="font-weight: 500; color: #000">&#8358;{{ number_format($paymentlist->BillAmount,2) }}</td>
							<td style="font-weight: 500; color: #000">&#8358;{{ number_format($paymentlist->AmountPaid,2) }}</td>
							<td style="font-weight: 500; color: #000">&#8358;{{ number_format($paymentlist->AmountOS,2) }}</td>
              <td style="font-weight: 500; color: #000">{{ $paymentlist->StaffName}}</td>
						</tr>
            @endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->
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
                <div class="modal-body" style="background: #eee; color: #000">
                  <div class="modal-header" style="background: #eee; color: #000">
                  <h5 class="text-left p-b-5"><span class="semi-bold">Bill Payment
                </div><hr>
                  <div class="row">
                  	<div style="padding: 20px; margin-bottom: 20px">
                  		<div class="col-md-12">
                  			<span>Customer Name</span>
                  			<p  class="text-primary" style="color: #fff; font-weight: 600; font-size: 25px; color: #000" id="customername"></p>
                  		</div><br><br>
                  		<div class="col-md-6">
                  			<span>Bill Amount</span>
                  			<p  class="text-primary" style="color: #fff; font-weight: 600; font-size: 16px; color: #000" id="bill-amt">&#8358;</p>
                  		</div>
                  		<div class="col-md-6">
                  			<span>Amount Outstanding</span>
                  			<p  class="text-primary" style="color: #fff; font-weight: 600; font-size: 16px; color: #000" id="bill-os">&#8358;</p>
                  		</div>
                  	</div><hr><br>
                  	
                    <div class="col-md-12"><hr>
                      {{ Form::open(['action' => 'CashEntryController@store_bill_payment_list', 'autocomplete' => 'off', 'role' => 'form']) }}
                       <div class="col-sm-6">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('GLIDDebit', 'Cash or Bank') }}
                                    <select name="GLIDDebit" id="dropDown" class="full-width" data-init-plugin="select2" required>
                                    	<option value="">Select Cash or Bank</option>}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                               <div class="controls">
                                   <label for="">Amount Paid</label>
                                   <input type="text" id="formattedNumberField" max=""  name="Amount"  class="form-control smartinput" required>
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
                                   <input type="text" name="PostDate" id="getvaluedate" value="" class="form-control" readonly="">
                               </div>
                           </div>
                       </div>
                       
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('Narration', 'Narration' ) }}
                                        {{ Form::textarea('Narration', null, ['class' => 'form-control', 'placeholder' => 'Enter Narration', 'rows'=>'2', 'id'=>'naration']) }}
                                    </div>
                                </div>
                            </div>
                        
                        <input type="hidden" name="Posted" value="1">
                      <input type="hidden" name="StaffID" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="PostingTypeID" value="16">
                      <input type="hidden" name="CurrencyID" value="1">
                      <input type="hidden" name="GLIDCredit" value="" id="getGLIDDebit">
                      <input type="hidden" name="Reference1" value="" id="billid">
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
</div>
@endsection
 @push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script>
    $(function(){
        var options = {
            todayHighlight: true,
            autoclose:true,
            format: 'yyyy-mm-dd'
        };
         $('.dp').datepicker({autoclose:true});
    });
</script>
  <script>
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var billid = $(this).data('billid');
            $("#modalFillIn #getBillID").val(billid);

            var customer = $(this).data('customer');
            $("#modalFillIn #getCustomer").val(customer);

            var billAmount = $(this).data('billamount');
            $("#modalFillIn #getBillAmount").val(billAmount);

            var amountpaid = $(this).data('amountpaid');
            $("#modalFillIn #getAmountPaid").val(amountpaid);

            var amountos = $(this).data('amountos');
            $("#modalFillIn #getAmountOS").val(amountos);

            var gliddebit = $(this).data('gliddebit');
            $("#modalFillIn #getGLIDDebit").val(gliddebit);

            var valuedate = $(this).data('valuedate');
            $("#modalFillIn #getvaluedate").val(valuedate);

            var customername = $(this).data('customer');
            $("#modalFillIn #customername").html(customername);
            $("#modalFillIn #bill-amt").html('&#8358;'+ parseInt(billAmount).toLocaleString());
            $("#modalFillIn #bill-os").html('&#8358;'+ parseInt(amountos).toLocaleString());
            $("#modalFillIn #billid").val(billid);
            $("#naration").val(billid +' : '+ customername);

            var cash = $(this).data('debit');
            $("#modalFillIn #Cash").val(cash);
            var myJsonString = { location: cash};
               var myDDL = document.getElementById("dropDown");
                 for (i = 0; i < myJsonString.location.length; i++) {
                    var option = document.createElement("option");
                    option.text = myJsonString.location[i].CUST_ACCT;
                    option.value = myJsonString.location[i].GLRef;
                    try {
                        myDDL.options.add(option);
                    }
                    catch (e) {
                        alert(e);
                    }                 }

              $("#formattedNumberField").blur(function(){
                var amt = $(this).val();
                  if(parseInt(amt) > parseInt(amountos)){
                    alert("Amount Paid cant be greater than Amount outstanding");
                   }
              });

              $("#post").on("click",function(){
                var amt = $("#formattedNumberField").val();
                  if(parseInt(amt) > parseInt(amountos)){
                    alert("Amount Paid cant be greater than Amount outstanding");
                   }
              });
          });
  </script>

@endpush

