@extends('layouts.master')

@push('styles')


@endpush

@push('styles')
<style>
	body.menu-pin .page-container .page-content-wrapper .footer {
		left: 0 !important;
	}
</style>
@endpush

@section('content')

	<!-- START PAGE CONTENT -->
	<div class="">
		<!-- START CONTAINER FLUID -->
		<div class="card-box">
			<!-- START PANEL -->
			<div class="">
				<div class="panel-heading">
					<div class="card-title">Staff Goals
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					@if(count($appraisals) > 0)

						<div class="table-responsive">
							<table class="table table-hover tableWithSearch nowrap">
								<thead>
								<tr>
									<th >Staff</th>
									<th >Period</th>
									<th >Date Submitted</th>
									<th >Action</th>
									<th >Status</th>
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
													<a href="{{ route('appraisal.supervisorViewAppraisal', ['appraisalID' => $appraisal->id]) }}" class="btn btn-info btn-sm">View</a>
												</p>
												<p>
													@if($appraisal->status == 2)
														<a href="{{ route('appraisal.submitToHr', ['appraisalID' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Submit to HR</a>
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
										<td>
											<p class="alert alert-info">No Appraisal has been submitted yet!</p>
										</td>
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


@endpush