@extends('layouts.master')

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
				<div class="panel-title">
					Cash Entry Listing
				</div>
				<div class="pull-right">
					<div class="col-xs-12">
						<input type="text" class="search-table form-control pull-right" placeholder="Search">
					</div>
				</div>
				<div class="clearfix"></div>
			<div class="panel-body">
				<table class="table tableWithSearch">
					<thead>
						<th>Customer Name</th>
						<th>View Transaction details</th>
					</thead>
					<tbody>
						@foreach ($gls as $gl)
						<tr>
							<td><h5>{{$gl->Customer}}</h5></td>
							<td class="actions">
								<a href="{{route('transactions.show',[$gl->GLRef]) }}" class="btn btn-info">View Account Statement</a>
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



