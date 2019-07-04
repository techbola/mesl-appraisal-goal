<div class="tab-pane active padding-20 slide-left" id="tab2">
	<div class="row row-same-height">

		<div class="col-md-12">
			<form action="{{ route('appraisal.bsc_financial.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				{{-- Financial --}}
				<div class="row clearfix">
					<div class="col-md-12">
					<h4>Financial</h4>
						<table class="table">
							<thead>
							<tr>
								<th scope="col" class="text-center text-white bg-orange">Objectives</th>
								<th scope="col" class="text-center text-white bg-orange">KPIs</th>
								<th scope="col" class="text-center text-white bg-orange">Target</th>
								<th scope="col" class="text-center text-white bg-orange">Constraints</th>
								<th scope="col" class="text-center text-white bg-info">
									<a style="color: orange;font-size: 30px;" title="Add More Field" id="addFinancialRow">
										<i class="fa fa-plus-circle"></i>
									</a>
								</th>
							</tr>
							</thead>
							<tbody id="financial_dynamic_field">

								<tr>
									<td>
										<div class="form-group form-group-default">
											<input type="text" class="form-control" name="financial_objective[]">
										</div>
									</td>
									<td>
										<div class="form-group form-group-default">
											<input type="text" class="form-control" name="financial_kpi[]">
										</div>
									</td>
									<td>
										<div class="form-group form-group-default">
											<input type="text" class="form-control" name="financial_target[]">
										</div>
									</td>
									<td>
										<div class="form-group form-group-default">
											<input type="text" class="form-control" name="financial_constraint[]">
										</div>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>

				<div class="form-group-attached">
					<div class="row clearfix">
						<div class="col-md-12">
							<input type="hidden" name="appraisalID" value="{{ $appraisalID }}">
							<button class="btn btn-orange btn-cons btn-animated" type="submit">
								<span>Save & Continue</span>
							</button>
						</div>
					</div>
				</div>

			</form>
		</div>


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
									<th style="width:1%">
										<form action="{{ route('appraisal.deleteFinanceAppraisals') }}" method="post">
											{{ csrf_field() }}
											<input type="hidden" name="appraisalIDs" id="appraisalIDs">
											<button type="submit" class="btn btn-danger">
												<i class="pg-trash"></i>
											</button>
										</form>
									</th>
									<th style="width:20%">Objectives</th>
									<th style="width:20%">KPIs</th>
									<th style="width:15%">Targets</th>
									<th style="width:20%">Constraints</th>
									<th style="width:5%">Action</th>
								</tr>
								</thead>
								<tbody>

									@foreach($appraisal_finances as $appraisal_finance)
										<tr>
											<td class="v-align-middle">
												<div class="checkbox ">
													<input type="checkbox"  id="financeAppraisal-{{ $appraisal_finance->id }}" value="{{ $appraisal_finance->id }}" onclick="displayMsg()">
													<label for="financeAppraisal-{{ $appraisal_finance->id }}"></label>
												</div>
											</td>
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
												<!-- Button trigger modal -->
												<button type="button" class="btn btn-primary editFinanceDialog"
														data-id="{{ $appraisal_finance->id }}"
														data-objective="{{ $appraisal_finance->objective }}"
														data-kpi="{{ $appraisal_finance->kpi }}"
														data-targets="{{ $appraisal_finance->target }}"
														data-constraint="{{ $appraisal_finance->constraint }}"
														data-toggle="modal"
														data-target="#financeModal">
													Edit
												</button>
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