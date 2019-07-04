<div class="tab-pane active padding-20 slide-left" id="tab2">
	<div class="row row-same-height">

		@if($appraisal_finances->count() > 0)

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="card-box">
					<div class="panel-heading">
						<div class="panel-title">Financial</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">

						<form action="{{ route('financialAppraisalUpdate') }}" method="post" enctype="multipart/form-data">
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

										@foreach($appraisal_finances as $appraisal_finance)
											<tr>
												<td class="v-align-middle ">
													<p>
														{{ $appraisal_finance->objective }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->kpi }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->target }}
													</p>
												</td>
												<td class="v-align-middle">
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="selfAssessment[]"
															   value="{{ $appraisal_finance->selfAssessment ? $appraisal_finance->selfAssessment : '' }}">
													</div>
												</td>
												<td class="v-align-middle">
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="comment[]"
															   value="{{ $appraisal_finance->staffAppraisalComment ? $appraisal_finance->staffAppraisalComment : '' }}">
													</div>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->supervisorAssessment }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->supervisorAppraisalComment }}
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