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
			Configure Payroll Group Annual Pay Structure
		</div>
		<div class="clearfix"></div>

		<div class="panel-body">
			@include('errors.list')
			{{ Form::open(['action' => 'PayrollAdjustmentController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('Scenario','Payroll Level') }}
				            {{ Form::select('Scenario', [ null =>  'Payroll Level'] + $payroll_level->pluck('Scenario', 'ScenarioRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Payroll Level", 'data-init-plugin' => "select2"]) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('BaseAmount','Base Amount') }}
				            {{ Form::text('BaseAmount', null, ['class'=> "form-control smartinput",'placeholder' => 'E.g 20000.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('GroupDescription','Group Description') }}
				            {{ Form::text('GroupDescription', null, ['class'=> "form-control", 'placeholder' => 'E.g Cavidel Intern Employee']) }}
				        </div>
				</div>

				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('STIRate','STI Rate') }}
				            {{ Form::text('STIRate', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('Basic','Basic') }}
				            {{ Form::text('Basic', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('Housing','Housing') }}
				            {{ Form::text('Housing', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>

				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('Transport','Transport') }}
				            {{ Form::text('Transport', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('Utilities','Utilities') }}
				            {{ Form::text('Utilities', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('Leave','Leave') }}
				            {{ Form::text('Leave', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>

				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('MealSubsidy','Meal Subsidy') }}
				            {{ Form::text('MealSubsidy', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('Reimbursibles','Reimbursibles') }}
				            {{ Form::text('Reimbursibles', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('Medicals','Medicals') }}
				            {{ Form::text('Medicals', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>

				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('Furniture','Furniture') }}
				            {{ Form::text('Furniture', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('Dressing','Dressing') }}
				            {{ Form::text('Dressing', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('CarMaintenance','Car Maintenance') }}
				            {{ Form::text('CarMaintenance', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>


				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('OtherAllowance','Other Allowance') }}
				            {{ Form::text('OtherAllowance', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('Drivers','Drivers') }}
				            {{ Form::text('Drivers', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('Travel','Travel') }}
				            {{ Form::text('Travel', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>

				<div class="row">
				        <div class="form-group col-sm-4">
				            {{ Form::label('ClubandProfessional','Club and Professional') }}
				            {{ Form::text('ClubandProfessional', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('Bonus13thMonth','Bonus 13th Month') }}
				            {{ Form::text('Bonus13thMonth', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('ProductivityBonus','Productivity Bonus') }}
				            {{ Form::text('ProductivityBonus', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>

				{{-- <h4>Deductions</h4> --}} <hr>

				<div class="row">
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('SeniorityLevel','Level') }}
				            {{ Form::select('SeniorityLevel', [ null =>  'Seniority Level'] + $payroll_level->pluck('Scenario', 'ScenarioRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Payroll Level", 'data-init-plugin' => "select2"]) }}
				        </div>
					
				        <div class="form-group col-sm-4">
				            {{ Form::label('LifeAssurance','Life Assurance') }}
				            {{ Form::text('LifeAssurance', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>

				        <div class="form-group col-sm-4">
				            {{ Form::label('Welfare','Welfare') }}
				            {{ Form::text('Welfare', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
				        </div>
				</div>



				<div class="action-btns row">
					<button class="btn btn-success">Test Button</button>
				</div>
			{{Form::close()}}
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
            <h5></h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">	
				
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection
