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
						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>
									@if($ap->status == 4 || $ap->status == 2 || $ap->status == 6)
										<th style="width:20%">Objectives</th>
										<th style="width:15%">KPIs</th>
										<th style="width:15%">Targets</th>
										<th style="width:20%">Constraints</th>
										<th style="width:15%;">Supervisor's Comment</th>
										<th style="width:15%;">HR's Comment</th>
									@elseif($ap->status != 4 && $ap->status != 2)
										<th style="width:20%">Objectives</th>
										<th style="width:20%">KPIs</th>
										<th style="width:15%">Targets</th>
										<th style="width:20%">Constraints</th>
										<th style="width:25%;">Comment</th>
									@endif
								</tr>
								</thead>
								<tbody>

									@if($ap->status == 4 || $ap->status == 2 || $ap->status == 6)
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
													<p>
														{{ $appraisal_learning->constraint }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_learning->justification ? $appraisal_learning->justification : '' }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_learning->hrComment ? $appraisal_learning->hrComment : '' }}
													</p>
												</td>
											</tr>
										@endforeach
									@elseif($ap->status != 4 && $ap->status != 2)
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
													<p>
														{{ $appraisal_learning->constraint }}
													</p>
												</td>
												<td class="v-align-middle">
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="learning_comment[]"
														value="{{ $appraisal_learning->justification ? $appraisal_learning->justification : '' }}">
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