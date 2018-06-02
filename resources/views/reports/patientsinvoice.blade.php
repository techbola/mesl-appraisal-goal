@extends('layouts.master')
@push('styles')
<style>
.shadow{
	-webkit-box-shadow: 10px 7px 8px -6px rgba(179,179,179,0.79);
-moz-box-shadow: 10px 7px 8px -6px rgba(179,179,179,0.79);
box-shadow: 10px 7px 8px -6px rgba(179,179,179,0.79);
}
</style>
@endpush

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			bill Report 
		</div><hr>
	</div>
	<div class="panel-body">
    <div class="row">
    	<div class="style="padding: 10px; background: #e3dff0">
    		<form method="post">
	    	<div class="row">
	    		<div class="form-group col-md-6">
	                  {{ Form::label('StartDate', 'Start Date') }}
	                {{ Form::date('start', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'id'=>'start']) }}
              </div>

         <div class="form-group col-md-6">
            {{ Form::label('End Date', 'End Date') }}
            {{ Form::date('end', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'onchange'=>'getdata()', 'id'=>'end']) }}
        </div>
     </div><hr>

    		<table class="table table-condensed" id="detailtable">
    			<thead>
    				<tr>
    					<th style="font-size: 14px; color: #000">Billing Code</th>
                        <th style="font-size: 14px; color: #000">Patient Name</th>
                        <th style="font-size: 14px; color: #000">Bill Amount</th>
                        <th style="font-size: 14px; color: #000">Amount Paid</th>
                        <th style="font-size: 14px; color: #000">Outstanding</th>
                        <th style="font-size: 14px; color: #000">Details</th>
    				</tr>
    			</thead>
    			<tbody class="load-bills">
    				
    			</tbody>
    		</table>
    	</div>
</div>
 <!-- Modal -->
          <div class="modal fade slide-up" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog modal-lg">
              <div class="modal-content-wrapper">
                <div class="modal-content">
                  <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h4 id="biller"></h4>
                    <h5>Bill Information <span class="semi-bold">Information</span></h5>
                  </div>
                  <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                                <th style="font-size: 14px; color: #000" class="text-primary">BillDate</th>
                                <th style="font-size: 14px; color: #000">Service</th>
                                <th style="font-size: 14px; color: #000">Quantity</th>
                                <th style="font-size: 14px; color: #000">Bill Amt</th>
                                <th style="font-size: 14px; color: #000">Discount</th>
                                <th style="font-size: 14px; color: #000" class="text-sucess">AmountPaid</th>
                                <th style="font-size: 14px; color: #000" class="text-danger">Outstanding</th>
                        </thead>
                        <tbody class="payment">
                            
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
          <!-- /.modal-dialog -->
@endsection
 @push('scripts') 
<script src="{{ asset('assets/js/accounting.js') }}" type="text/javascript">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        };
        $('.dp').datepicker({autoclose:true});
    })
</script>
<script>
	function getdata()
	{
		var startDate = $('#start').val();
		var endDate = $('#end').val();
		var token = '{{ csrf_token() }}';

		var data = {
			_token:token,
			startDate:startDate,
			endDate:endDate
		};

		$.post('/test/patientsinvoice', data, function(data, textStatus, xhr) {
            console.log(data);
			
            $.each(data, function(index, val) {
                $('.load-bills').append(`
                    <tr >
                        <td style="font-size : 14px; font-weight: 600">`+val.GroupID+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.Fullname+`</td>
                        <td style="font-size : 14px; font-weight: 600; color:green">&#8358;`+accounting.formatNumber(val.BillAmount)+`</td>
                        <td style="font-size : 14px; font-weight: 600; color:green">&#8358;`+accounting.formatNumber(val.Paid)+`</td>
                        <td style="font-size : 14px; font-weight: 600; color:red">&#8358;`+accounting.formatNumber(val.Outstanding)+`</td>
                        <td><a href="#"  class="btn btn-xs btn-rounded btn-primary saka" data-billref="`+val.GroupID+`" title="">View Bill</a></td>
                       
                    </tr>
                    `);
            });

           $(".saka").click(function(e) {
               e.preventDefault();
               var selected_bill_ref = $(this).data("billref");
               var data = {selected_bill_ref:selected_bill_ref};
               $.get('/get/paymentdetails/' + selected_bill_ref, function(data, textStatus, xhr) {
                 $('.payment').empty();
             $.each(data, function(index, val) {
                $('.payment').append(`
                    <tr >
                        <td style="font-size : 14px; font-weight: 600" class="text-primary">`+val.BillingDate+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.Produt_ServiceType+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.Quantity+`</td>
                        <td style="font-size : 14px; font-weight: 600">&#8358;`+accounting.formatNumber(val.Price)+`</td>
                        <td style="font-size : 14px; font-weight: 600">&#8358;`+accounting.formatNumber(val.Discount)+`</td>
                        <td style="font-size : 14px; font-weight: 600" class="text-success">&#8358;`+accounting.formatNumber(val.AmountPaid)+`</td>
                        <td style="font-size : 14px; font-weight: 600" class="text-danger">&#8358;`+accounting.formatNumber(val.AmountOutstanding)+`</td>
                    </tr>
                    `);
            });

            var bill_modal =  $("#modalSlideUp");
               bill_modal.find("#biller").html(selected_bill_ref);
                bill_modal.modal('show');

           
       });
               

           });
	   });
	}
</script>
@endpush
    
