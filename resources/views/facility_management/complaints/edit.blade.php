@extends('layouts.master')
@section('buttons')
  <a href="{{ route('facility-management.complaints.create') }}" class="btn btn-info btn-rounded pull-right" >New Complaint</a>
	&nbsp;
  <a href="{{ route('facility-management.complaints.index') }}" class="btn btn btn-rounded pull-right" >Complaints List</a>
@endsection

@section('content')

<div class="card-box">
	<div class="card-title pull-left">Edit Complaint</div>
	<div class="pull-right">
		<div class="col-xs-12">
			<input type="text" class="search-table form-control pull-right" placeholder="Search">
		</div>
	</div>
	<div class="clearfix"></div>
	{{ Form::model($complaint, ['action' => ['ComplaintController@update', $complaint->id ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('facility_management.complaints.form', ['buttonText' => 'Update Complaint'])
	{{ Form::close() }}
</div>
@endsection


