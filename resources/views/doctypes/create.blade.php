@extends('layouts.master')

@section('content')
<div class="card-box">
	<div class="card-title">Create Document Type</div>
	{{ Form::open(['action' => 'DocTypeController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
	@include('doctypes.form', ['buttonText' => 'Create Document Type '])
	{{ Form::close() }}
</div>

	<!-- START PANEL -->
	<div class="card-box">
			<div class="card-title">Document Type Listing</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
			<table class="table tableWithSearch">
				<thead>
					<th>Document Type </th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($DocTypes as $DocType)
						<tr>
						<td>{{ $DocType->DocType }}</td>
						<td class="actions">
							<a href="{{ route('doctypes.edit',[$DocType->DocRef]) }}" class="btn btn-info">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
	<!-- END PANEL -->
@endsection
