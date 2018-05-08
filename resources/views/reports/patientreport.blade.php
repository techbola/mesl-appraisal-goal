@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Patient Report  
		</div><hr>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<div style="padding: 20px; background: #eee; height: 350px; overflow-y: scroll;">
					<h3>Patient Registered</h3>
					<hr>
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
					<table class="table table-condensed table-hover" id="detailtable">
    			<thead>
    				<tr>
    					<th style="font-size: 11px; color: #000">Branch</th>
                        <th style="font-size: 11px; color: #000">Total Amount</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<td>Magodo</td>
    					<td><span style="font-weight: 600" class="magodoP"></span></td>
    				</tr>
    				<tr>
    					<td>Victoria Island</td>
    					<td><span style="font-weight: 600" class="VIP"></span></td>
    				</tr>
    				<tr>
    					<td>CMD</td>
    					<td><span style="font-weight: 600" class="CMD"></span></td>
    				</tr>
    				<tr>
    					<td>Total Registered Patient</td>
    					<td><span style="font-weight: 600" class="totalp"></span></td>
    				</tr>
    			</tbody>
    		</table>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding: 20px; background: #f1f3e1; height: 350px; overflow-y: scroll;">
					<h3>Patient Registered Per Staff</h3><hr>
					<form method="post">
						<div class="row">
							<div class="form-group col-md-6">
	                            {{ Form::label('StartDate', 'Start Date') }}
	                                {{ Form::date('start', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'id'=>'staff-start']) }}
                            </div>

                            <div class="form-group col-md-6">
                                    {{ Form::label('End Date', 'End Date') }}
                                        {{ Form::date('end', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'onchange'=>'getstaffdata()', 'id'=>'staff-end']) }}
                            </div>
						</div>
					</form>
					<table class="table table-condensed table-hover" id="detailtable">
    			<thead>
    				<tr>
    					<th style="font-size: 11px; color: #000">Staff Name</th>
                        <th style="font-size: 11px; color: #000">Total Patient Registered</th>
    				</tr>
    			</thead>
    			<tbody class="load-patient-count">
    				
    			</tbody>
    		</table>
				</div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-6">
				<div style="padding: 20px; background: #e1f2f3; height: 350px; overflow-y: scroll;">
					<h3>Patient Registered Per HMO</h3><hr>
					<form method="post">
						<div class="row">
							<div class="form-group col-md-6">
	                            {{ Form::label('StartDate', 'Start Date') }}
	                                {{ Form::date('start', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'id'=>'hmo-start']) }}
                            </div>

                            <div class="form-group col-md-6">
                                    {{ Form::label('End Date', 'End Date') }}
                                        {{ Form::date('end', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'onchange'=>'gethmodata()', 'id'=>'hmo-end']) }}
                            </div>
						</div>
					</form>
					<table class="table table-condensed table-hover" id="detailtable">
    			<thead>
    				<tr>
    					<th style="font-size: 11px; color: #000">Staff Name</th>
                        <th style="font-size: 11px; color: #000">Total Patient Registered</th>
    				</tr>
    			</thead>
    			<tbody class="load-hmo-count">
    				
    			</tbody>
    		</table>
				</div>
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

		$.post('/get/patientreportdetails', data, function(data, textStatus, xhr) {
            
			$.each(data.magodo, function(index, val) {
				 $('.magodoP').html(val.Total);
			});

			$.each(data.VI, function(index, val) {
				 $('.VIP').html(val.Total);
			});
			$.each(data.CMD, function(index, val) {
				 $('.CMD').html(val.Total);
			});

			$.each(data.total, function(index, val) {
				 $('.totalp').html(val.Total);
			});
			

	   });
	}

	function getstaffdata()
	{
		var startDate = $('#staff-start').val();
		var endDate = $('#staff-end').val();
		var token = '{{ csrf_token() }}';

		var data = {
			_token:token,
			startDate:startDate,
			endDate:endDate
		};

		$.post('/get/patient_report_by_staff', data, function(data, textStatus, xhr) {
            console.log(data);
			 $.each(data, function(index, val) {
                $('.load-patient-count').append(`
                    <tr >
                        <td style="font-size : 11px; font-weight: 600">`+val.StaffName+`</td>
                        <td style="font-size : 11px; font-weight: 600">`+val.PatientCount+`</td>
                    </tr>
                    `);
            });
			

	   });
	}

	function gethmodata()
	{
		var startDate = $('#hmo-start').val();
		var endDate = $('#hmo-end').val();
		var token = '{{ csrf_token() }}';

		var data = {
			_token:token,
			startDate:startDate,
			endDate:endDate
		};

		$.post('/get/patient_report_by_hmo', data, function(data, textStatus, xhr) {
            console.log(data);
			 $.each(data, function(index, val) {
                $('.load-hmo-count').append(`
                    <tr>
                        <td style="font-size : 11px; font-weight: 600">`+val.HMO+`</td>
                        <td style="font-size : 11px; font-weight: 600">`+val.HMOCount+`</td>
                    </tr>
                    `);
            });
	   });
	}
</script>
@endpush

