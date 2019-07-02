<div class="tab-pane slide-left padding-20" id="tab6">
	<div class="row row-same-height">
		<div class="col-md-12">
			<div class="padding-30">

				<div class="row clearfix">
					<div class="col-md-12">
						<h4>Behavioural Appraisal</h4>

						@foreach($behaviourals  as $behavioural)
							<table class="table">
								<thead>
								<tr>
									<th scope="col" class="text-left text-white bg-primary">{{ $behavioural->behaviouralCat }}</th>
									<th scope="col" scope="col" class="text-left text-white bg-primary">Weight</th>
									<th scope="col" class="text-left text-white bg-primary">Self Assessment</th>
									<th scope="col" class="text-left text-white bg-primary">Supervisor Assessment</th>
									<th scope="col" class="text-left text-white bg-primary">Supervisor Comment</th>
								</tr>
								</thead>
								<tbody>
								@foreach($behavioural->behaviouralStaffItems($staffLevelID) as $behavioural_item)
									<tr>
										<td>
											{{ $behavioural_item->behaviouralItem }}
										</td>
										<td>
											{{ $behavioural_item->weight }}
										</td>
										<td>
											{{ $behavioural_item->staffBehaviouralItem->selfAssessment }}
										</td>

										@if($ap->appraisalStatus == 2)
											<td>
												{{ $behavioural_item->staffBehaviouralItem->supervisorAssessment }}
											</td>
											<td>
												{{ $behavioural_item->staffBehaviouralItem->supervisorComment }}
											</td>

										@else
										<td>
											<div class="form-group form-group-default">
												<input type="text" class="form-control" name="supervisorAssessment[]"
												value="{{ $behavioural_item->staffBehaviouralItem ?
															    $behavioural_item->staffBehaviouralItem->supervisorAssessment :
															    '' }}">
											</div>
										</td>
										<td>
											<div class="form-group form-group-default">
												<input type="text" class="form-control" name="supervisorComment[]"
												value="{{ $behavioural_item->staffBehaviouralItem ?
															    $behavioural_item->staffBehaviouralItem->supervisorComment :
															    '' }}">
											</div>
										</td>

										@endif

									</tr>
								@endforeach
								</tbody>
							</table>
						@endforeach
					</div>
				</div>

			</div>
		</div>
	</div>
</div>