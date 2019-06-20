@extends('layouts.master')

@push('styles')

	<link href="{{ asset('main/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />

@endpush

@section('content')

	<!-- START PAGE CONTENT -->
	<div class="">
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg bg-white">
			<!-- START PANEL -->
			<div class="panel panel-transparent">
				<div class="panel-heading">
					<div class="panel-title">Staff Goals
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					@if(count($appraisals) > 0)

						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>
									<th style="width:40%">Staff</th>
									<th style="width:5%">Period</th>
									<th style="width:25%">Date Submitted</th>
									<th style="width:15%">Action</th>
									<th style="width:15%">Status</th>
								</tr>
								</thead>
								<tbody>

									@foreach($appraisals as $appraisal)

										<tr>
											<td class="v-align-middle ">
												<p>{{ $appraisal->staff->user->first_name. ' ' .$appraisal->staff->user->last_name }}</p>
											</td>
											<td class="v-align-middle ">
												<p>{{ $appraisal->period }}</p>
											</td>
											<td class="v-align-middle">
												<p>{{ $appraisal->updated_at->toFormattedDateString() }}</p>
											</td>
											<td class="v-align-middle">
												<p>
													<a href="{{ route('supervisorViewAppraisal', ['appraisalID' => $appraisal->id]) }}" class="btn btn-info btn-sm">View</a>
												</p>
												<p>
													@if($appraisal->status == 2)
														<a href="{{ route('submitToHr', ['appraisalID' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Submit to HR</a>
													@endif
												</p>
											</td>
											<td class="v-align-middle">
												@if($appraisal->status == 2)
													<p>Approved</p>
												@elseif($appraisal->status == 4)
													<p>Approved, sent to HR</p>
												@elseif($appraisal->status == 6)
													<p>Approved by HR</p>
												@else
													<p>Not Yet Seen</p>
												@endif
											</td>
										</tr>

									@endforeach
								@else
									<tr>
										<td>No Appraisal has been submitted yet!</td>
									</tr>

								</tbody>
							</table>
						</div>

					@endif

				</div>
			</div>
			<!-- END PANEL -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->

@endsection

@push('scripts')

	<script src="{{ asset('main/assets/js/tables.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/js/scripts.js') }}" type="text/javascript"></script>

@endpush