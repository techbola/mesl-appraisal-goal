@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_group">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Edit <strong>{{ $pag->GroupDescription }}</strong>  Group
		</div>
		<div class="clearfix"></div>

		<div class="panel-body">
			{{ Form::model($pag, ['action' => ['PayrollController@update_group', $pag->GroupRef], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
			{{ method_field('PATCH') }}
				@include('payroll.groups.form')
				<div class="action-btns row">
					<button class="btn btn-success">Update Group</button>
				</div>
			{{ Form::close() }}	
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
          	
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection
