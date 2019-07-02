<div class="tab-pane padding-20 slide-left" id="tab7">
	<div class="row row-same-height">

		<div class="col-md-12">

			<form action="{{ route('appraisal.other_appraisal.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				{{-- Comment --}}
				@if(!$comments)

					<div class="form-group-attached">
						<div class="form-group form-group-default required">
							<label>Appraisee's Comment</label>
							<input type="text" class="form-control" name="appraisee_comment">
						</div>
						@if(auth()->user()->staff->SupervisorFlag)
							<div class="form-group form-group-default required">
								<label>Appraiser's Comment</label>
								<input type="text" class="form-control" name="appraiser_comment">
							</div>
						@endif
					</div>

				@endif
				<br>

				{{-- Recommendation --}}
				@if(auth()->user()->staff->SupervisorFlag)
				<div class="form-group-attached">
					<h4>Recommendation</h4>
					<div class="row clearfix">
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Promote</label>
								<input type="text" class="form-control" name="recommendation_promote">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Commendation</label>
								<input type="text" class="form-control" name="recommendation_commendation">
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Performance Improvement  (Mentoring & Coaching)</label>
								<input type="text" class="form-control" name="recommendation_performance">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Exit</label>
								<input type="text" class="form-control" name="recommendation_exit">
							</div>
						</div>
					</div>
				</div>
				<br>
				@endif

				@if(auth()->user()->staff->SupervisorFlag)
				{{-- Training Need --}}
				<div class="form-group-attached">
					<div class="form-group form-group-default required">
						<label>Training Need</label>
						<input type="text" class="form-control" name="training_need">
					</div>
				</div>
				<br>
				@endif

				{{-- Signature --}}
				<div class="form-group-attached">
					<div class="row clearfix">
						@if(!$comments)
							<div class="col-sm-3">
								<div class="form-group form-group-default required">
									<label>Appraisee Sign</label>
									<input type="file" class="form-control" name="appraisee_sign">
								</div>
							</div>
						@endif
						@if(auth()->user()->staff->SupervisorFlag)
							<div class="col-sm-3">
								<div class="form-group form-group-default required">
									<label>Appraiser Sign</label>
									<input type="file" class="form-control" name="appraiser_sign">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group form-group-default required">
									<label>Executive Director Sign</label>
									<input type="file" class="form-control" name="executive_sign">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group form-group-default required">
									<label>HR Sign</label>
									<input type="file" class="form-control" name="hr_sign">
								</div>
							</div>
						@endif
					</div>
				</div>
				<br>

				<div class="form-group-attached">
					<div class="row clearfix">
						<div class="col-md-12">
							@if(!$comments)
								<input type="hidden" name="appraisalID" value="{{ $appraisalID }}">
								<button class="btn btn-primary btn-cons btn-animated" type="submit">
									<span>Save & Continue</span>
								</button>
							@endif
						</div>
					</div>
				</div>

			</form>

		</div>

		<div class="col-md-12" style="margin-top: 20px;">
			<div class="container">
				<div class="row">

					@if($comments)

						<div class="col-md-9">
							<!-- START PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="panel-title">Appraisee Comment</div>
								</div>
								<div class="panel-body">
									<p>
										{{ $comments->appraiseeComment }}
									</p>
									<hr>
									<p>

										<button type="button" class="btn btn-primary editCommentDialog"
												data-id="{{ $comments->id }}"
												data-comment="{{ $comments->appraiseeComment }}"
												data-toggle="modal"
												data-target="#commentModal">
											Edit
										</button>
										<a href="{{ route('appraisal.deleteAppraisalComment', ['cID' => $comments->id]) }}" class="btn btn-danger btn-sm">Delete</a>

									</p>
								</div>
							</div>
							<!-- END PANEL -->

						</div>

						@else

							<p></p>

					@endif

					<div class="col-md-3">

						@if($signatures)

							<img src="{{ asset($signatures->appraiseeSign) }}" alt="{{ asset($signatures->appraiseeSign) }}">

							<hr>

							<p>

								<button type="button" class="btn btn-primary editSignDialog"
										data-id="{{ $signatures->id }}"
										data-toggle="modal"
										data-target="#signatureModal">
									Edit
								</button>
								<a href="{{ route('appraisal.deleteAppraisalSignature', ['signID' => $signatures->id]) }}" class="btn btn-danger btn-sm">Delete</a>

							</p>

							@else

								<p></p>

						@endif


					</div>

				</div>
			</div>
		</div>

	</div>
</div>