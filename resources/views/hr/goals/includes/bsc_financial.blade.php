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
						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>

									@if($ap->status != 6)
										<th style="width:20%">Objectives</th>
										<th style="width:15%">KPIs</th>
										<th style="width:15%">Targets</th>
										<th style="width:20%">Constraints</th>
										<th style="width:15%">Supervisor's Comment</th>
										<th style="width:15%;">Comment</th>
									@else($ap->status == 6)
										<th style="width:20%">Objectives</th>
										<th style="width:15%">KPIs</th>
										<th style="width:15%">Targets</th>
										<th style="width:20%">Constraints</th>
										<th style="width:15%">Supervisor's Comment</th>
										<th style="width:15%;">HR Comment</th>
									@endif

								</tr>
								</thead>
								<tbody>

									@if($ap->status != 6)
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
													<p>
														{{ $appraisal_finance->constraint }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->justification ? $appraisal_finance->justification : '' }}
													</p>
												</td>
												<td class="v-align-middle">
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="financial_comment[]">
													</div>
												</td>
											</tr>
										@endforeach

									@else($ap->status == 6)
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
													<p>
														{{ $appraisal_finance->constraint }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->justification ? $appraisal_finance->justification : '' }}
													</p>
												</td>
												<td class="v-align-middle">
													<p>
														{{ $appraisal_finance->hrComment ? $appraisal_finance->hrComment : '' }}
													</p>
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