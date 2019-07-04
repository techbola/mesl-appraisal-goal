<div class="tab-pane padding-20 slide-left" id="tab4">
	<div class="row row-same-height">

		@if($appraisal_internals->count() > 0)

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="card-box">
					<div class="panel-heading">
						<div class="panel-title">Internal Process</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">

						<form action="{{ route('appraisal.internalAppraisalStore') }}" method="post" enctype="multipart/form-data">
							@csrf

							<div class="table-responsive">
								<table class="table table-hover" id="basicTable">
									<thead>
									<tr>
										<th style="width:20%">Objectives</th>
										<th style="width:20%">KPIs</th>
										<th style="width:20%">Targets</th>
										<th style="width:15%">Self Assessment</th>
										<th style="width:25%">Comment</th>
									</tr>
									</thead>
									<tbody>

									@foreach($appraisal_internals as $appraisal_internal)
										<tr>
											<td class="v-align-middle ">
												<p>
													{{ $appraisal_internal->objective }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_internal->kpi }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_internal->target }}
												</p>
											</td>
											<td class="v-align-middle">
												<div class="form-group form-group-default">
													<input type="text" class="form-control" name="selfAssessment[]"
														   value="{{ $appraisal_internal->selfAssessment ? $appraisal_internal->selfAssessment : '' }}">
												</div>
											</td>
											<td class="v-align-middle">
												<div class="form-group form-group-default">
													<input type="text" class="form-control" name="comment[]"
														   value="{{ $appraisal_internal->staffAppraisalComment ? $appraisal_internal->staffAppraisalComment : '' }}">
												</div>
											</td>
										</tr>
									@endforeach

									</tbody>
								</table>
							</div>

							<div class="form-group-attached">
								<div class="row clearfix">
									<div class="col-md-12">
										<input type="hidden" name="appraisalID" value="{{ $appraisalID }}">
										<button class="btn btn-primary btn-cons btn-animated" type="submit">
											<span>Save & Continue</span>
										</button>
									</div>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>

		@endif

	</div>
</div>