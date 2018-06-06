@extends('layouts.master')
@section('buttons')
  <a href="{{ route('memos.index') }}" class="btn btn-info btn-rounded pull-right" >Complaints Form</a>
@endsection
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Create Memo</div>
  			<div class="clearfix"></div>
  			
			 {{ Form::open(['action' => 'MemoController@store', 'autocomplete' => 'off', 'files' => true, 'novalidate' => 'novalidate', 'role' => 'form']) }}
          @include('estate_management.complaints.form', ['buttonText' => 'Create Memo'])
		   {{ Form::close() }}

  	</div>

  	<div class="card-box hide">
  		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
  	</div>
  	<!-- END PANEL -->

@endsection



