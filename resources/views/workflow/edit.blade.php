@extends('layouts.master')

@section('content')

<div class="card-box">
	<div class="card-title pull-left">Edit Workflow</div>
	<div class="pull-right">
		<div class="col-xs-12">
			<input type="text" class="search-table form-control pull-right" placeholder="Search">
		</div>
	</div>
	<div class="clearfix"></div>
	{{ Form::model($workflow, ['action' => ['WorkflowController@update', $workflow->WorkflowRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('workflow.form', ['buttonText' => 'Update Workflow'])
	{{ Form::close() }}
</div>
@endsection


