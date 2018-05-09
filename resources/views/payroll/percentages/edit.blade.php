@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_p">New Percentage Group</button>
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_p">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Payroll Percentages (Scenerio)
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search" style="width: 200px; margin-left: 10px">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			{{ Form::model($pp,['action' => ['PayrollController@update_percentage', $pp->ScenarioRef], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
			 {{ method_field('PATCH') }}
			@include('payroll.percentages.form')

			<button class="btn btn-complete" type="submit">Update Record</button>
			{{ Form::close() }}
		</div>
	</div>
	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_p" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>New Payroll Percentage</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">	
				{{ Form::open(['action' => 'PayrollController@setup_percentages', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('payroll.percentages.form')

				<button class="btn btn-complete" type="submit">Add Record</button>
				{{ Form::close() }}
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection
