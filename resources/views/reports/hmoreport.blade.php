@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			HMO Report  
		</div><hr>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<div style="padding: 20px; background: #e8deeb; height: 350px; overflow-y: scroll;">
					<h3>Amount Paid by each HMO</h3><hr>
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
						</div>
					</form>
						<div>
					<table class="table table-hover" id="detailtable">
    			<thead>
    				<tr>
    					<th style="font-size: 11px; color: #000">HMO</th>
                        <th style="font-size: 11px; color: #000">Amount Paid</th>
                        <th style="font-size: 11px; color: #000">Outsatnding</th>
                        <th style="font-size: 11px; color: #000">View</th>
    				</tr>
    			</thead>
    			<tbody class="hmoreport">
    				
    			</tbody>
    		</table>
    	</div>
    	</div>
				</div>
		</div>
		
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
                    <h5>Payment <span class="semi-bold">Information</span></h5>
                  </div>
                  <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                              <th style="font-size: 14px; color: #000">Billing Date</th>
                              <th style="font-size: 14px; color: #000">Bill Code</th>
                              <th style="font-size: 14px; color: #000">Name</th>
                              <th style="font-size: 14px; color: #000">HMO</th>
                              <th style="font-size: 14px; color: #000">Products</th>
                              <th style="font-size: 14px; color: #000">Amount Paid</th>  
                              <th style="font-size: 14px; color: #000">Outstanding</th>
                              <th style="font-size: 14px; color: #000">Quantity</th>
                        </thead>
                        <tbody class="payment"  style="height: 300px">
                            
                        </tbody>
                    </table>
                </div>
                  </div>
                </div>
              </div>
              <!-- /.modal-content -->
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

		$.post('/get/hmofinancial', data, function(data, textStatus, xhr) {
            console.log(data);
			 $.each(data, function(index, val) {
                $('.hmoreport').append(`
                    <tr>
                        <td style="font-size : 11px; font-weight: 600">`+val.HMO+`</td>
                        <td style="font-size : 11px; font-weight: 600">&#8358;`+accounting.formatNumber(val.Paid)+`</td>
                        <td style="font-size : 11px; font-weight: 600">&#8358;`+accounting.formatNumber(val.Outstanding)+`</td>
                        <td><a href="#" title="" class="activate-modal" data-hmoref="`+val.HMO+`"><i class="fa fa-search-plus"></i></a></td>
                    </tr>
                    `);
            });


           $(".activate-modal").click(function(e) {
               e.preventDefault();
               var ref = $(this).data("hmoref");
               // var data = {ref:ref};
               $.get('/get/hmopaymentdetails/' + ref, function(data, textStatus, xhr) {
            var bill_modal =  $("#modalSlideUp");
              
            	 $.each(data, function(index, val) {
                $('.payment').append(`
                    <tr >
                        <td style="font-size : 14px; font-weight: 600" class="text-primary">`+val.BillingDate+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.GroupID+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.FirstName+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.HMO+`</td>
                        <td style="font-size : 14px; font-weight: 600">`+val.Produt_ServiceType+`</td>
                        <td style="font-size : 14px; font-weight: 600" class="text-success">&#8358;`+accounting.formatNumber(val.AmountPaid)+`</td>
                        <td style="font-size : 14px; font-weight: 600" class="text-danger">&#8358;`+accounting.formatNumber(val.AmountOutstanding)+`</td>
                        <td style="font-size : 14px; font-weight: 600" class="text-danger">`+val.Quantity+`</td>
                    </tr>
                    `);
            });

                bill_modal.modal('show');

           
       });
               

           });
			

	   });
	}

</script>
@endpush

