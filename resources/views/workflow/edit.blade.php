@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Workflow
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($workflow, ['action' => ['WorkflowController@update', $workflow->WorkflowRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('workflow.form', ['buttonText' => 'Update Workflow'])
		{{ Form::close() }}
	</div>
</div>
@endsection


