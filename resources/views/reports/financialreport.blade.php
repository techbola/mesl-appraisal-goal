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
			Financial Reports 
		</div>
	</div><hr>
	<div class="panel-body">
    <div class="row">
    	<div class="col-md-6 shadow" style="padding: 10px; background: #e3dff0">
    		<h4>Revenue</h4>
    		<form method="post">
	    	<div class="row">
	    		<div class="form-group col-md-6">
	                  {{ Form::label('StartDate', 'Start Date') }}
	                <div class="input-group date dp">
	                {{ Form::text('start', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'id'=>'start']) }}
	                <span class="input-group-addon">
	                    <i class="fa fa-calendar">
	                    </i>
	                </span>
	              </div>
              </div>

         <div class="form-group col-md-6">
            {{ Form::label('End Date', 'End Date') }}
            <div class="input-group date dp">
                {{ Form::text('end', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'onchange'=>'getdata()', 'id'=>'end']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
     </div>
    		<hr>

    		<table class="table table-condensed">
    			<thead>
    				<tr>
    					<th style="font-size: 11px; color: #000">Location</th>
    					<th style="font-size: 11px; color: #000">Paid</th>
    					<th style="font-size: 11px; color: #000">Outstanding</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td>Magodo</td>
    					<td>&#8358;<span style="font-weight: 600" class="magodoP"></span></td>
    					<td>&#8358;<span style="font-weight: 600" class="magodoO"></span></td>
    				</tr>
    				<tr>
    					<td>Ikeja</td>
    					<td>&#8358;<span style="font-weight: 600" class="viP"></span></td>
    					<td>&#8358;<span style="font-weight: 600" class="viO"></span></td>
    				</tr>
    				<tr>
    					<td>CMD</td>
    					<td>&#8358;<span style="font-weight: 600" class="cmdP"></span></td>
    					<td>&#8358;<span style="font-weight: 600" class="cmdO"></span></td>
    				</tr>
    				<tr>
    					<td>Total</td>
    					<td>&#8358;<span style="font-weight: 600" class="totalP"></span></td>
    					<td>&#8358;<span style="font-weight: 600" class="totalO"></span></td>
    				</tr>
    			</tbody>
    		</table>
    	</div>

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

		$.post('/test/reports', data, function(data, textStatus, xhr) {

			$.each(data.magodo, function(index, val) {
				 $('.magodoP').html(val.Paid.toLocaleString());
			$('.magodoO').html(val.Outstanding);
			});
			$.each(data.vi, function(index, val) {
				 $('.viP').html(val.Paid);
			$('.viO').html(val.Outstanding);
			});
			$.each(data.cmd, function(index, val) {
				 $('.cmdP').html(val.Paid);
			$('.cmdO').html(val.Outstanding);
			});
			$.each(data.total, function(index, val) {
				 $('.totalP').html(val.Paid);
			$('.totalO').html(val.Outstanding);
			});
		});
	}
</script>
@endpush