@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Request For Leave
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'LeaveRequestController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('leaverequest.form', ['buttonText' => 'Request For Leave'])
		{{ Form::close() }}
	</div>
</div>
@endsection

{{-- @section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Gender Listing
			</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table tableWithSearch">
				<thead>
					<th>Gender </th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($genders as $gender)
						<tr>
						<td>{{ $gender->Gender }}</td>
						<td class="actions">
							<a href="{{ route('genders.edit',[$gender->GenderRef]) }}" class="btn btn-info">EDIT</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection
 --}}