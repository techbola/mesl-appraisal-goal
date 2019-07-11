@extends('layouts.master')

@push('styles')

	<link href="{{ asset('main/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />

@endpush

@section('content')

	<!-- START PAGE CONTENT -->
	<div class=" ">
		<!-- START CONTAINER FLUID -->
		<div class="">
			<!-- START PANEL -->
			<div class="card-box">
				<div class="panel-heading">
					<div class="panel-title">Staff Appraisal
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					@if(count($appraisals) > 0)

						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>
									<th style="width:20%">Staff</th>
									<th style="width:20%">Supervisor</th>
									<th style="width:10%">Period</th>
									<th style="width:20%">Action</th>
									<th style="width:15%">Appraisal Status</th>
								</tr>
								</thead>
								<tbody>

									@foreach($appraisals as $appraisal)

										<tr>
											<td class="v-align-middle ">
												<p>{{ $appraisal->staff->user->getFullNameAttribute() }}</p>
											</td>
											<td class="v-align-middle ">
												<p>{{ $appraisal->staff->supervisor->getFullNameAttribute() }}</p>
											</td>
											<td class="v-align-middle ">
												<p>{{ $appraisal->period }}</p>
											</td>
											<td class="v-align-middle">
												<p>
													<a href="{{ route('appraisal.hrViewStaffAppraisal', ['appraisalID' => $appraisal->id]) }}" class="btn btn-info btn-sm">View Appraisal</a>
												</p>
												<p>
													<a href="{{ route('appraisal.hrViewScoreReport', ['appraisalID' => $appraisal->id]) }}" class="btn btn-success btn-sm">View Score Report</a>
												</p>
											</td>
											<td class="v-align-middle">
												@if($appraisal->appraisalStatus == 2)
													<p>Approved by {{ $appraisal->staff->supervisor->getFullNameAttribute() }}</p>
												@else
													<p>Not Yet Approved</p>
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