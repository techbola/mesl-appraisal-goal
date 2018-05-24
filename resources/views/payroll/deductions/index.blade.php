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
			Deductions
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<button id="process_payroll" class="btn btn-success" title="Updates Employee's payroll group">Process Payroll</button>
				<a href="{{ route('payroll.deduction.manual') }}" class="btn btn-info" title="Updates Employee's payroll group">Add Deductions/Payments</a>
				<input type="text" class="search-table form-control pull-right" placeholder="Search" style="width: 200px; margin-left: 10px">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<table class="table tableWithSearch table-striped table-bordered">
				<thead>
					<th>Staff Name</th>
					<th>Deduction</th>
					<th>Month</th>
					<th>Amount</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($current_deductions as $deduction)
					<tr>
						<td>{{ $deduction->staff->Fullname }}</td>
						<td>{{ $deduction->deduction}}</td>
						<td>{{ \Carbon\Carbon::parse(max($max_date))->format('M') }}</td>
						<td>{{ nairazify(number_format($deduction->Amount, 2)) }}</td>
						<td></td>
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
				            {{ Form::label('MonthStartDate','Start Date') }}
				            <div class="input-group date dp">
				                {{ Form::text('MonthStartDate', null, ['class' => 'form-control', 'placeholder' => 'Satrt Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar">
				                    </i>
				                </span>
				            </div>
				        </div>

				        <div class="form-group col-sm-6">
				            {{ Form::label('MonthStartDate','Month Start Date') }}
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
	$('#process_payroll').click(function(e) {
		// e.preventDefault();
		var button_text = $(this).html();
		var that = $(this);
		$.ajax({
			url: '{{ url('/payroll/process-payroll') }}',
			type: 'POST',
			beforeSend: function(){
				that.text('Processing Payroll...');
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
