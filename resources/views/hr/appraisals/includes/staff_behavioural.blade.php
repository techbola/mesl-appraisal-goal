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
									<th scope="col" class="text-left text-white btn-orange">{{ $behavioural->behaviouralCat }}</th>
									<th scope="col" scope="col" class="text-left text-white btn-orange">Weight</th>
									<th scope="col" class="text-left text-white btn-orange">Self Assessment</th>
									<th scope="col" class="text-left text-white btn-orange">Supervisor Assessment</th>
									<th scope="col" class="text-left text-white btn-orange">Supervisor Comment</th>
								</tr>
								</thead>
								<tbody>

									@foreach($behavioural->behaviouralStaffItems($staffPositionID) as $behavioural_item)
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

											<td>
												{{ $behavioural_item->staffBehaviouralItem->supervisorAssessment }}
											</td>
											<td>
												{{ $behavioural_item->staffBehaviouralItem->supervisorComment }}
											</td>
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