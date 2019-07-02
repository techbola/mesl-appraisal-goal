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
						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>
									<th style="width:20%">Objectives</th>
									<th style="width:15%">KPIs</th>
									<th style="width:15%">Targets</th>
									<th style="width:5%">Staff <br> Assessment</th>
									<th style="width:20%">Staff <br> Comment</th>
									<th style="width:5%">Supervisor <br> Assessment</th>
									<th style="width:20%">Supervisor <br> Comment</th>
								</tr>
								</thead>
								<tbody>

									@if($ap->appraisalStatus == 4 || $ap->appraisalStatus == 2)
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
													<p>
														{{ $appraisal_internal->selfAssessment }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_internal->staffAppraisalComment }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_internal->supervisorAssessment }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_internal->supervisorAppraisalComment }}
													</p>
												</td>
											</tr>
										@endforeach
									@elseif($ap->appraisalStatus != 4 && $ap->appraisalStatus != 2)
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
													<p>
														{{ $appraisal_internal->selfAssessment }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_internal->staffAppraisalComment }}
													</p>
												</td>
												<td class="v-align-middle">
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="i_supervisorAssessment[]"
															   value="{{ $appraisal_internal->supervisorAssessment ? $appraisal_internal->supervisorAssessment : '' }}">
													</div>
												</td>
												<td class="v-align-middle">
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="i_supervisorComment[]"
															   value="{{ $appraisal_internal->supervisorAppraisalComment ? $appraisal_internal->supervisorAppraisalComment : '' }}">
													</div>
												</td>
											</tr>
										@endforeach
									@endif

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		@endif

	</div>
</div>