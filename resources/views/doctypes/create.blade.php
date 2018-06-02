@extends('layouts.master')

@section('buttons')
  <button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_doctype">+ New Document Type</button>
@endsection

@section('content')
{{-- <div class="card-box">
	<div class="card-title">Create Document Type</div>
	{{ Form::open(['action' => 'DocTypeController@store', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('doctypes.form', ['buttonText' => 'Create Document Type '])
	{{ Form::close() }}
</div> --}}

<div class="modal fade" id="new_doctype" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Create Document Type</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
				{{ Form::open(['action' => 'DocTypeController@store', 'autocomplete' => 'off', 'role' => 'form']) }}
					@include('doctypes.form', ['buttonText' => 'Save'])
				{{ Form::close() }}
      </div>
    </div>
  </div>
</div>

	<!-- START PANEL -->
	<div class="card-box">
			<div class="card-title pull-left">Document Type Listing</div>
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
							<a href="{{ route('doctypes.edit', $DocType->DocTypeRef) }}" class="btn btn-info btn-sm">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
	<!-- END PANEL -->
@endsection
