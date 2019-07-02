<div class="tab-pane padding-20 slide-left" id="tab3">
	<div class="row row-same-height">

		@if($appraisal_customers->count() > 0)

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="panel panel-transparent">
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
									<th style="width:20%">Constraints</th>
									<th style="width:15%">Supervisor Comment</th>
									<th style="width:15%">HR Comment</th>
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
												{{ $appraisal_customer->constraint }}
											</p>
										</td>
										<td class="v-align-middle">
											<p>
												{{ $appraisal_customer->justification ? $appraisal_customer->justification : '' }}
											</p>
										</td>
										<td class="v-align-middle">
											<p>
												{{ $appraisal_customer->hrComment ? $appraisal_customer->hrComment : '' }}
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