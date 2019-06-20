<div class="tab-pane slide-left padding-20" id="tab6">
	<div class="row row-same-height">
		<div class="col-md-12">
			<div class="padding-30">

			<form action="{{ route('staff_behavioural.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row clearfix">
					<div class="col-md-12">
						<h4>Behavioural Appraisal</h4>

						@foreach($behaviourals  as $behavioural)
							<table class="table">
								<thead>
								<tr>
									<th scope="col" class="text-left text-white bg-primary">{{ $behavioural->behaviouralCat }}</th>
									<th scope="col" class="text-left text-white bg-primary">Weight</th>
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
									</tr>
								@endforeach
								</tbody>
							</table>
						@endforeach
					</div>
				</div>

			</form>

			</div>
		</div>
	</div>
</div>