@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_staff">Set Payroll Period</button>
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_staff">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Payroll Details
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<button id="apply_updates" class="btn btn-info" title="Updates Employee's payroll group">Apply update to employees</button>
				{{-- <input type="text" class="search-table form-control pull-right" placeholder="Search" style="width: 200px; margin-left: 10px"> --}}
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<table id="pay_details_table" class="table  table-striped table-bordered">
				<thead>
					<th>Staff Name</th>
					<th>Basic</th>
					<th>Housing</th>
					<th>Transport</th>
					<th>Meal</th>
					<th>Utility</th>
					<th>Leave</th>
					<th>Dressing</th>
					<th>Gross Pay</th>
					<th>Pension</th>
					<th>PAYE Tax</th>
					<th>Monthly Deduction</th>
					<th>Net Pay</th>
				</thead>
				<tbody>
					@foreach($payroll_details as $pd)
					<tr>
						<td>{{ $pd->staff->firstname. ' '. $pd->staff->lastname ?? 'No Name' }}</td>
						<td>{{ number_format($pd->Basic, 2) }}</td>
						<td>{{ number_format($pd->Housing, 2) }}</td>
						<td>{{ number_format($pd->Transport, 2) }}</td>
						<td>{{ number_format($pd->MealSubsidy, 2) }}</td>
						<td>{{ number_format($pd->Utilities, 2) }}</td>
						<td>{{ number_format($pd->Leave, 2) }}</td>
						<td>{{ number_format($pd->Dressing, 2) }}</td>
						<td>{{ number_format($pd->GrossPay, 2) }}</td>
						<td>{{ number_format($pd->Pension, 2) }}</td>
						<td>{{ number_format($pd->PAYETax, 2) }}</td>
						<td>{{ number_format($pd->TotalDeductions, 2) }}</td>
						<td>{{ number_format($pd->ToBeNetPay, 2) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_staff" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4>Configure Pay Period</h4>
            <p class="p-b-10">Choose a <b>start date</b> and <b>end date</b></p>
          </div>
          <div class="modal-body">

				{{ Form::open(['action' => 'PayrollRateController@store']) }}
					<div class="row">
						<div class="form-group col-sm-6">
				            {{ Form::label('MonthStartDate','Month Start Date') }}
				            <div class="input-group date dp">
				                {{ Form::text('MonthStartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar">
				                    </i>
				                </span>
				            </div>
				        </div>

				        <div class="form-group col-sm-6">
				            {{ Form::label('MonthStartDate','Month End Date') }}
				            <div class="input-group date dp">
				                {{ Form::text('MonthEndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar">
				                    </i>
				                </span>
				            </div>
				        </div>
					</div>


					<div class="row">
						<div class="col-xs-12">
							<button class="btn btn-success">Set payroll dates</button>
						</div>
					</div>
				{{ Form::close() }}

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection


@push('scripts')
<script>
		$('#pay_details_table').DataTable({
			dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
			buttons: [
                'print', 'pdf', 'excel', 'csv'
            ]
		});
	</script>
<script>
	$('#apply_updates').click(function(e) {
		// e.preventDefault();
		var button_text = $(this).html();
		var that = $(this);
		$.ajax({
			url: '{{ url('/payroll/apply-updates') }}',
			type: 'POST',
			beforeSend: function(){
				that.text('Applying Update...');
			}
		})
		.done(function(data) {
			that.text(button_text);
			showNotification('bar', data , 'top', 5000, 'success');
		})
		.fail(function(error) {
			that.text(button_text);
			console.log(error);
		});

	});
</script>
@endpush
