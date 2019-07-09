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
			<h4>Add New Behavioural Item</h4>
			<div class="col-lg-8 col-md-6 ">
				<!-- START PANEL -->
				<div class="card-box">
					<div class="panel-body">
						<form role="form" action="{{ route('appraisal.behavioural_item.store') }}" method="post">
							@csrf
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group form-group-default">
										<label>Item Name</label>
										<input type="text" class="form-control" name="behaviouralItem" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Select Behavioural Category</label>
										<select name="behaviouralCat_id" id="behaviouralCat_id" class="full-width" style="height: 50px;">

											@foreach($behaviourals as $behavioural)
												<option value="{{ $behavioural->id }}">{{ $behavioural->behaviouralCat }}</option>
											@endforeach

										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group form-group-default">
										<label>Weight</label>
										<input type="text" class="form-control" name="weight" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Assign to Position</label>
										<select name="level_id" id="level_id" class="full-width" style="height: 50px;">

											@foreach($positions as $position)
												<option value="{{ $position->id }}">{{ $position->Position }}</option>
											@endforeach

										</select>
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

	@if(count($behavioural_items) > 0)

		<!-- START CONTAINER FLUID -->
		<div class="">
			<!-- START PANEL -->
			<div class="card-box">
				<div class="panel-heading">
					<div class="panel-title">Behavioural Categories
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-hover" id="basicTable">
							<thead>
							<tr>
								<th style="width:20%">Behavioural</th>
								<th style="width:20%">Item</th>
								<th style="width:20%">Position</th>
								<th style="width:10%">Weight</th>
								<th style="width:15%">Date Added</th>
								<th style="width:15%">Action</th>
							</tr>
							</thead>
							<tbody>

							@foreach($behavioural_items as $behavioural_item)

								<tr>
									<td class="v-align-middle ">
										{{ $behavioural_item->behavioural->behaviouralCat }}
									</td>
									<td class="v-align-middle ">
										{{ $behavioural_item->behaviouralItem }}
									</td>
									<td class="v-align-middle ">
										{{ $behavioural_item->position->Position }}
									</td>
									<td class="v-align-middle ">
										{{ $behavioural_item->weight }}
									</td>
									<td class="v-align-middle ">
										{{ $behavioural_item->created_at->toFormattedDateString() }}
									</td>
									<td class="v-align-middle">
										<p>
										<form action="{{ route('appraisal.behavioural_item.destroy', ['id' => $behavioural_item->id]) }}" method="post">
											@csrf
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-danger btn-sm" onclick="confirm('Are you sure that you want this item deleted?')">Delete</button>
										</form>
										</p>
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