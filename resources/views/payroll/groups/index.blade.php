@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_group">Add new group</button>
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_group">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Payroll Groups
		</div>
		<div class="clearfix"></div>

		<div class="panel-body">
			<table class="tableWithSearch table-striped table-bordered">
				<thead>
					<th>Actions</th>
					<th>Group Description</th>
					<th>Seniority Level</th>
					<th>STI Rate</th>
					<th>Base Amount</th>
					<th>Scenario</th>
					<th>Basic</th>
					<th>Housing</th>
					<th>Transport</th>
					<th>Utilities</th>
					<th>Leave</th>
					<th>Meal Subsidy</th>
					<th>Re-Imbursibles</th>
					<th>Medicals</th>
					<th>Furniture</th>
					<th>Dressing</th>
					<th>Car Maintenance</th>
					<th>Drivers</th>
					<th>Travel</th>
					<th>13<sup>th</sup> Month</th>
					<th>Other Allowance</th>
					<th>Total Deductions</th>
					<th>Gross Pay</th>
					<th>Net Pay</th>
				</thead>
				<tbody>
					@foreach($payroll_groups as $pg)
					<tr>
						<td>
							<a href="/payroll/groups/edit/{{ $pg->GroupRef }}" class="btn btn-inverse">Edit</a>
						</td>
						<td>{{ $pg->GroupDescription }}</td>
						<td>{{ $pg->seniority_level->GradeLevel }}</td>
						<td>{{ nairazify(number_format($pg->STIRate, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->BaseAmount, 2)) }}</td>
						<td>{{ $pg->scenario->Scenario }}</td>
						<td>{{ nairazify(number_format($pg->Basic, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Housing, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Transport, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Utilities, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Leave, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->MealSubsidy, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->ReImbursibles, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Medicals, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Furniture, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Dressing, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->CarMaintenance, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Drivers, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Travel, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->Bonus13thMonth, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->OtherAllowance, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->TotalAllowance, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->GrossPay, 2)) }}</td>
						<td>{{ nairazify(number_format($pg->NetPay, 2)) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal -->
  <div class="modal fade slide-up" id="new_group" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5></h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">	
          	{{ Form::open(['action' => 'PayrollAdjustmentController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('payroll.groups.form')
				<div class="action-btns row">
					<button class="btn btn-success">Create Group</button>
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
