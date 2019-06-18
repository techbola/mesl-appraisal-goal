@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Setup Holidays
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'HolidayController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('holidays.form', ['buttonText' => 'Submit'])
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Holidays
			</div>
		
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table tableWithSearch">
				<thead>
					<th>Holiday</th>
					<th>Holiday Name</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($holidays as $holiday)
						<tr>
						<td>{{ \Carbon\Carbon::parse($holiday->Holiday)->toFormattedDateString() }}</td>
						<td>{{ $holiday->HolidayName }}</td>
						<td class="actions">
							<a href="{{ route('holidays.edit',[$holiday->HolidayRef]) }}" class="btn btn-info btn-sm">EDIT</a>
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
