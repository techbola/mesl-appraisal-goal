@extends('layouts.master')
@section('content')

	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_doc">New Document</button>
	</div> --}}

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Set Approval Levels</div>
  			<div class="pull-right">
  				<div class="col-xs-12">
  					<input type="text" class="search-table form-control pull-right" placeholder="Search">
  				</div>
  			</div>
  			<div class="clearfix"></div>
  			{{ Form::open(['action' => 'WorkflowController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('workflow.form', ['buttonText' => 'Set Workflow'])
			{{ Form::close() }}

  	</div>

  	<div class="card-box">
  			<div class="card-title pull-left">Workflows per module</div>
  			<div class="pull-right">
  				<div class="col-xs-12">
  					<input type="text" class="search-table form-control pull-right" placeholder="Search">
  				</div>
  			</div>
  			<div class="clearfix"></div>
  			<table class="table tableWithSearch">
	<thead>
		<th>Module </th>
		<th>Initiator</th>
		<th>Approver 1</th>
		<th>Approver 2</th>
		<th>Approver 3</th>
		<th>Approver 4</th>
		<th></th>
	</thead>

	<tbody>
		@foreach($workflowdata as $workflow)
		<tr>
			<td>
				@if($workflow->ModuleID == 1)
				Document Flow
				@endif
			</td>
			<td>{{ Cavidel\User::find($workflow->RequesterID)->Fullname ?? '-' }}</td>
			<td>{{ is_null(Cavidel\User::find($workflow->ApproverID1))  ? '' : Cavidel\User::find($workflow->ApproverID1)->Fullname }}</td>
			<td>{{ is_null(Cavidel\User::find($workflow->ApproverID2))  ? '' : Cavidel\User::find($workflow->ApproverID2)->Fullname  }}</td>
			<td>{{ is_null(Cavidel\User::find($workflow->ApproverID3))  ? '' : Cavidel\User::find($workflow->ApproverID3)->Fullname }}</td>
			<td>{{ is_null(Cavidel\User::find($workflow->ApproverID4))  ? '' : Cavidel\User::find($workflow->ApproverID4)->Fullname }}</td>
			<td>
				<a href="{{ route('workflow.edit', [$workflow->WorkflowRef]) }}" class="btn btn-sm btn-complete">Edit</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

  	</div>
  	<!-- END PANEL -->



@endsection



