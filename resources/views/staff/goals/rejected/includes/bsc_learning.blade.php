<div class="tab-pane padding-20 slide-left" id="tab5">
	<div class="row row-same-height">

		<div class="col-md-12">
			<form action="{{ route('bsc_learning.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				{{-- People/Learning --}}
				<div class="row clearfix">
					<div class="col-md-12">
						<h4>People/Learning</h4>
						<table class="table">
							<thead>
							<tr>
								<th scope="col" class="text-center text-white bg-orange">Objectives</th>
								<th scope="col" class="text-center text-white bg-orange">KPIs</th>
								<th scope="col" class="text-center text-white bg-orange">Target</th>
								<th scope="col" class="text-center text-white bg-orange">Constraint</th>
								<th scope="col" class="text-center text-white bg-info">
									<a style="color: orange;font-size: 30px;" title="Add More Field" id="addLearningRow">
										<i class="fa fa-plus-circle"></i>
									</a>
								</th>
							</tr>
							</thead>
							<tbody id="learning_dynamic_field">
							<tr>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="learning_objective[]">
									</div>
								</td>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="learning_kpi[]">
									</div>
								</td>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="learning_target[]">
									</div>
								</td>
								<td>
									<div class="form-group form-group-default">
										<input type="text" class="form-control" name="learning_constraint[]">
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
							<button class="btn btn-primary btn-cons btn-animated" type="submit">
								<span>Save & Continue</span>
							</button>
						</div>
					</div>
				</div>

			</form>
		</div>

		@if($appraisal_learnings->count() > 0)

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="panel panel-transparent">
					<div class="panel-heading">
						<div class="panel-title">People/Learning</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover" id="basicTable">
								<thead>
								<tr>
									<th style="width:1%">
										<form action="{{ route('deleteLearningAppraisals') }}" method="post">
											{{ csrf_field() }}
											<input type="hidden" name="appraisalIDs" id="appraisalIDs3">
											<button type="submit" class="btn btn-danger">
												<i class="pg-trash"></i>
											</button>
										</form>
									</th>
									<th style="width:15%">Objectives</th>
									<th style="width:10%">KPIs</th>
									<th style="width:10%">Targets</th>
									<th style="width:20%">Constraints</th>
									<th style="width:20%">Supervisor Comment</th>
									<th style="width:20%">HR Comment</th>
									<th style="width:5%">Action</th>
								</tr>
								</thead>
								<tbody>

								@foreach($appraisal_learnings as $appraisal_learning)
									<tr>
										<td class="v-align-middle">
											<div class="checkbox ">
												<input type="checkbox"  id="learningAppraisal-{{ $appraisal_learning->id }}" value="{{ $appraisal_learning->id }}" onclick="displayMsg3()">
												<label for="learningAppraisal-{{ $appraisal_learning->id }}"></label>
											</div>
										</td>
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
										<td class="v-align-middle">
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary editLearningDialog"
													data-id="{{ $appraisal_learning->id }}"
													data-objective="{{ $appraisal_learning->objective }}"
													data-kpi="{{ $appraisal_learning->kpi }}"
													data-targets="{{ $appraisal_learning->target }}"
													data-constraint="{{ $appraisal_learning->constraint }}"
													data-toggle="modal"
													data-target="#learningModal">
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