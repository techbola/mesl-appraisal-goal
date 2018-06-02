@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Create Means of Identification 
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'IdentificationController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('identifications.form', ['buttonText' => 'Create Means of Identification'])
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
			Identification Listing
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
					@foreach ($identifications as $identification)
						<tr>
						<td>{{ $identification->Identification }}</td>
						<td class="actions">
							<a href="{{ route('identifications.edit',[$identification->IdentificationRef]) }}" class="btn btn-info">EDIT</a>
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
