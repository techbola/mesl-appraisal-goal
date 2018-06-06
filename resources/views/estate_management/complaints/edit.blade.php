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
	{{ Form::model($memo, ['action' => ['MemoController@update', $memo->id ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('memos.form', ['buttonText' => 'Update Memo'])
	{{ Form::close() }}
</div>
@endsection


