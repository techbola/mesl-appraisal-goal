@extends('layouts.master')

@push('styles')

	<link href="{{ asset('main/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />

@endpush

@section('content')

	<!-- Add Behavioural -->
	<div class="container-fluid">

		<div class="row" style="margin-top:100px;">
			<h4>Add New Level</h4>
			<div class="col-lg-8 col-md-6 ">
				<!-- START PANEL -->
				<div class="panel panel-transparent">
					<div class="panel-body">
						<form role="form" action="{{ route('levels.store') }}" method="post">
							@csrf
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group form-group-default">
										<label>Name</label>
										<input type="text" class="form-control" name="name" required>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<button class="btn btn-primary" type="submit">Add</button>
						</form>
					</div>
				</div>
				<!-- END PANEL -->
			</div>

		</div>

	</div>
	<!-- END -->

	@if(count($levels) > 0)

		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg bg-white">
			<!-- START PANEL -->
			<div class="panel panel-transparent">
				<div class="panel-heading">
					<div class="panel-title">All Levels
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-hover" id="basicTable">
							<thead>
							<tr>
								<th style="width:50%">Name</th>
								<th style="width:25%">Date Added</th>
								<th style="width:25%">Action</th>
							</tr>
							</thead>
							<tbody>

							@foreach($levels as $level)

								<tr>
									<td class="v-align-middle ">
										{{ $level->name }}
									</td>
									<td class="v-align-middle ">
										{{ $level->created_at->toFormattedDateString() }}
									</td>
									<td class="v-align-middle">
										<form action="{{ route('levels.destroy', ['id' => $level->id]) }}" method="post">
											@csrf
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-danger btn-sm" onclick="confirm('Are you sure that you want this item deleted?')">Delete</button>
										</form>
									</td>
								</tr>

							@endforeach

							</tbody>
						</table>
					</div>

				</div>
			</div>
			<!-- END PANEL -->
		</div>
		<!-- END -->

	@endif

@endsection

@push('scripts')

	<script src="{{ asset('main/assets/js/tables.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/js/scripts.js') }}" type="text/javascript"></script>

@endpush