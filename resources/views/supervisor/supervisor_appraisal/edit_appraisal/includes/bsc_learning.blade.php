<div class="tab-pane padding-20 slide-left" id="tab5">
	<div class="row row-same-height">

		@if($appraisal_learnings->count() > 0)

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="card-box">
					<div class="panel-heading">
						<div class="panel-title">People/Learning</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">

						<form action="{{ route('appraisal.supervisor.learningAppraisalUpdate') }}" method="post" enctype="multipart/form-data">
							@csrf

							<div class="table-responsive">
								<table class="table table-hover" id="basicTable">
									<thead>
									<tr>
										<th style="width:20%">Objectives</th>
										<th style="width:15%">KPIs</th>
										<th style="width:15%">Targets</th>
										<th style="width:5%">Self <br> Assessment</th>
										<th style="width:20%">Staff <br> Comment</th>
										<th style="width:5%">Supervisor's <br> Assessment</th>
										<th style="width:20%">Supervisor's <br> Comment</th>
									</tr>
									</thead>
									<tbody>

									@foreach($appraisal_learnings as $appraisal_learning)
										<tr>
											<td class="v-align-middle ">
												<p>
													{{ $appraisal_learning->objective }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_learning->kpi }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_learning->target }}
												</p>
											</td>
											<td class="v-align-middle">
												<div class="form-group form-group-default">
													<input type="text" class="form-control" name="selfAssessment[]"
														   value="{{ $appraisal_learning->selfAssessment ? (int) $appraisal_learning->selfAssessment : '' }}">
												</div>
											</td>
											<td class="v-align-middle">
												<div class="form-group form-group-default">
													<input type="text" class="form-control" name="comment[]"
														   value="{{ $appraisal_learning->staffAppraisalComment ? $appraisal_learning->staffAppraisalComment : '' }}">
												</div>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_learning->supervisorAssessment }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_learning->supervisorAppraisalComment }}
												</p>
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