@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Create Country 
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'CountryController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('countries.form', ['buttonText' => 'Create Country '])
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
			Country Listing
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
					<th>Country </th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($countries as $country)
						<tr>
						<td>{{ $country->Country }}</td>
						<td class="actions">
							<a href="{{ route('countries.edit',[$country->CountryRef]) }}" class="btn">EDIT</a>
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
