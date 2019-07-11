<div class="tab-pane slide-left padding-20" id="tab6">
	<div class="row row-same-height">
		<div class="col-md-12">
			<div class="padding-30">

				<form action="{{ route('appraisal.staff_behavioural.store') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="row clearfix">
						<div class="col-md-12">
							<h4>Behavioural Appraisal</h4>

							@foreach($behaviourals  as $behavioural)
								<table class="table">
									<thead>
									<tr>
										<th class="text-left text-white btn-orange">{{ $behavioural->behaviouralCat }}</th>
										<th class="text-left text-white btn-orange">Weight</th>
										<th class="text-left text-white btn-orange">Self Assessment</th>
										<th class="text-left text-white btn-orange">Supervisor Assessment</th>
										<th class="text-left text-white btn-orange">Supervisor Comment</th>
									</tr>
									</thead>
									<tbody>

										@foreach($behavioural->behaviouralUserItems as $behavioural_item)
											<tr>
												<td>
													{{ $behavioural_item->behaviouralItem }}
												</td>
												<td>
													{{ $behavioural_item->weight }}
												</td>
												<td>
													<div class="form-group form-group-default">
														<input type="text" class="form-control" name="selfAssess[]">
													</div>
												</td>
												<td></td>
												<td></td>
											</tr>
										@endforeach

									</tbody>
								</table>
							@endforeach
						</div>
					</div>
					<br>

					<div class="form-group-attached">
						<div class="row clearfix">
							<div class="col-md-12">
								<input type="hidden" name="appraisalID" value="{{ $appraisalID }}">
								<input type="hidden" name="behaviourals" value="{{ $behaviourals->pluck('id') }}">
								<button class="btn btn-primary btn-cons btn-animated" type="submit">
									<span>Save</span>
								</button>
							</div>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>