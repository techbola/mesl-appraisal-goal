@extends('layouts.master')
@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css') }}">
@endpush
@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Request For Leave
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'LeaveRequestController@store', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('leaverequest.form', ['buttonText' => 'Request For Leave'])
		{{ Form::close() }}
	</div>
</div>
@endsection
