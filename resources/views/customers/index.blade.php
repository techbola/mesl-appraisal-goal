@extends('layouts.master')

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Customer Listing
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
					<th>Customer Name</th>
					<th>Contact Phone</th>
					<th>BVN</th>
					<th>Occupation</th>
					<th>Email</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($customers as $customer)
						<tr>
						<td><b>{{ $customer->CustomerName }}</b></td>
						<td>{{ $customer->Telephone }}</td>
						<td>{{ $customer->BVN}}</td>
						<td>{{ $customer->Occupation }}</td>
						<td>{{ $customer->Email }}</td>
						<td class="actions">
							<a href="{{ route('customers.edit',[$customer->CustomerRef]) }}" class="btn">EDIT</a>
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