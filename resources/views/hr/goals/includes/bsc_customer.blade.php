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
												<div class="form-group form-group-default">
													<input type="text" class="form-control" name="customer_comment[]"
													value="{{ $appraisal_customer->hrComment ? $appraisal_customer->hrComment : '' }}">
												</div>
											</td>
										</tr>
									@endforeach

								@else($ap->status == 6)

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