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
					<div class="panel-title">Staff Goals
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="">

					@if(count($appraisals) > 0)

						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>
									<th style="width:25%">Staff</th>
									<th style="width:5%">Period</th>
									<th style="width:25%">Date Submitted</th>
									<th style="width:15%">Action</th>
									<th style="width:15%">Goal Status</th>
									<th style="width:15%">Appraisal Status</th>
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
													<a href="{{ route('appraisal.supervisorViewAppraisal', ['appraisalID' => $appraisal->id]) }}" class="btn btn-info btn-sm">View Goals</a>
												</p>

												@if($appraisal->status == 2)
													<p><a href="{{ route('appraisal.submitToHr', ['appraisalID' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Submit to HR</a></p>

												@elseif($appraisal->status == 6 && $appraisal->appraisalStatus == 1)
													<p><a href="{{ route('appraisal.supervisorViewStaffAppraisal', ['appraisalID' => $appraisal->id]) }}" class="btn btn-primary btn-sm">View Appraisal</a></p>

												@elseif($appraisal->status == 6 && $appraisal->appraisalStatus == 2)
													<p><a href="{{ route('appraisal.supervisorViewStaffAppraisal', ['appraisalID' => $appraisal->id]) }}" class="btn btn-primary btn-sm">View Appraisal</a></p>

												@endif

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
											<td class="v-align-middle">

												@if($appraisal->status == 2)
													<p>Approved</p>

												@elseif($appraisal->appraisalStatus == 1)
													<p>Appraisal Submitted by Staff</p>

												@elseif($appraisal->appraisalStatus == 2)
													<p>Appraisal Approved</p>

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