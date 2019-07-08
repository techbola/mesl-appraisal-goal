<div class="tab-pane padding-20 slide-left" id="tab4">
	<div class="row row-same-height">

		<div class="col-md-12">
			<form action="{{ route('appraisal.supervisor.bsc_internal.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				{{-- Internal Process --}}
				<div class="row clearfix">
					<div class="col-md-12">
						<h4>Internal Process</h4>
						<table class="table">
							<thead>
							<tr>
								<th scope="col" class="text-center text-white bg-orange">Objectives</th>
								<th scope="col" class="text-center text-white bg-orange">KPIs</th>
								<th scope="col" class="text-center text-white bg-orange">Target</th>
								<th scope="col" class="text-center text-white bg-orange">Constraint</th>
								<th scope="col" class="text-center text-white bg-info">
									<a style="color: darkorange;font-size: 30px;" title="Add More Field" id="addInternalRow">
										<i class="fa fa-plus-circle"></i>
									</a>
								</th>
							</tr>
							</thead>
							<tbody id="internal_dynamic_field">
							<tr>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="internal_process_objective[]">
									</div>
								</td>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="internal_process_kpi[]">
									</div>
								</td>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="internal_process_target[]">
									</div>
								</td>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="internal_process_constraint[]">
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
									<th style="width:1%">
										<form action="{{ route('appraisal.supervisor.deleteInternalAppraisals') }}" method="post">
											{{ csrf_field() }}
											<input type="hidden" name="appraisalIDs" id="appraisalIDs2">
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

								@foreach($appraisal_internals as $appraisal_internal)
									<tr>
										<td class="v-align-middle">
											<div class="checkbox ">
												<input type="checkbox"  id="internalAppraisal-{{ $appraisal_internal->id }}" value="{{ $appraisal_internal->id }}" onclick="displayMsg2()">
												<label for="internalAppraisal-{{ $appraisal_internal->id }}"></label>
											</div>
										</td>
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
												{{ $appraisal_internal->constraint }}
											</p>
										</td>
										<td class="v-align-middle">
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-orange editInternalDialog"
													data-id="{{ $appraisal_internal->id }}"
													data-objective="{{ $appraisal_internal->objective }}"
													data-kpi="{{ $appraisal_internal->kpi }}"
													data-targets="{{ $appraisal_internal->target }}"
													data-constraint="{{ $appraisal_internal->constraint }}"
													data-toggle="modal"
													data-target="#internalModal">
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