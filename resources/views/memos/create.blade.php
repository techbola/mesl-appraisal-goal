@extends('layouts.master')
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Create Memo</div>
  			<div class="clearfix"></div>
  			
  			{{ Form::open(['action' => 'MemoController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('memos.form', ['buttonText' => 'Create Memo'])
			{{ Form::close() }}

  	</div>

  	<div class="card-box">
  		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
  	</div>
  	<!-- END PANEL -->

@endsection



