@extends('layouts.master')


@section('title')
	Customer Management
@endsection

@section('page-title')
	Customer Management
@endsection

@section('page-title')
	Customer Management
@endsection

@section('content')
	<div class="clearfix m-b-20">
		<button class="c-btn c-btn--info pull-right" data-toggle="modal" data-target="#new_customer">New Customer</button>
	</div>

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">Customer Listing</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>

		<table class="table tableWithSearch">
			<thead>
				<th>Customer Name</th>
				<th>Contact Phone</th>
				<th>Email</th>
				<th>Projects</th>
				<th>Actions</th>
			</thead>
			<tbody>
				@foreach ($customers as $customer)
					<tr>
					<td><b>{{ $customer->Customer }}</b></td>
					<td>{{ $customer->Telephone }}</td>
					<td>{{ $customer->Email }}</td>
					{{-- <td>{{ $customer->BVN }}</td>
					<td>{{ $customer->Occupation }}</td> --}}
					<td>{{ count($customer->projects) }}</td>
					<td class="actions">
						<a href="{{ route('customers.edit', $customer->CustomerRef) }}" class="btn btn-inverse">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal -->
	<div class="modal fade slide-up disable-scroll" id="new_customer" tabindex="-1" role="dialog" aria-hidden="false">
		<div class="modal-dialog ">
			<div class="modal-content-wrapper">
				<div class="modal-content">
					<div class="modal-header clearfix text-left">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
						</button>
						<h5>Add New Customer</h5>
					</div>
					<div class="modal-body">
						{{ Form::open(['action' => 'CustomerController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
						@include('customers.form', ['buttonText' => 'Save'])
						{{ Form::close() }}

						{{-- <form action="{{ route('clients.store') }}" method="post">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="req">Client Name / Title</label>
										<input type="text" class="form-control" name="Name" placeholder="Eg. Microsoft Limited" required>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-info btn-form">Submit</button>
						</form> --}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
