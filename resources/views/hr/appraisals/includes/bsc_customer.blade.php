<div class="tab-pane padding-20 slide-left" id="tab3">
	<div class="row row-same-height">

		@if($appraisal_customers->count() > 0)

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="card-box">
					<div class="panel-heading">
						<div class="panel-title">Customer/Stakeholder</div>
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
									<th style="width:20%">Staff Assessment</th>
									<th style="width:20%">Staff Comment</th>
									<th style="width:15%">Supervisor Assessment</th>
									<th style="width:15%;">Supervisor Comment</th>
								</tr>
								</thead>
								<tbody>

									@foreach($appraisal_customers as $appraisal_customer)
										<tr>
											<td class="v-align-middle ">
												<p>
													{{ $appraisal_customer->objective }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_customer->kpi }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_customer->target }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_customer->selfAssessment }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_customer->staffAppraisalComment }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_customer->supervisorAssessment }}
												</p>
											</td>
											<td class="v-align-middle">
												<p>
													{{ $appraisal_customer->supervisorAppraisalComment }}
												</p>
											</td>
										</tr>
									@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		@endif

	</div>
</div>