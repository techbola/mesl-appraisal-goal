@extends('layouts.master')

@section('content')

	<div class="card-box" style="margin-top: 50px;">
		<div class="panel-heading">
			<div class="panel-title">All Appraisals</div>
			<div class="clearfix"></div>
		</div>

		@if($appraisals->count() > 0)

			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover" id="basicTable">
						<thead>
						<tr>
							<th style="width:20%">Period</th>
							<th style="width:20%">Supervisor</th>
							<th style="width:20%">Action</th>
							<th style="width:20%">Goal Status</th>
							<th style="width:20%">Appraisal Status</th>
						</tr>
						</thead>
						<tbody>

						@foreach($appraisals as $appraisal)

							<tr>
								<td class="v-align-middle ">
									<p>{{ $appraisal->period }}</p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $appraisal->staff->supervisor->getFullNameAttribute() }}</p>
								</td>
								<td class="v-align-middle">

									@if($appraisal->sentFlag && $appraisal->status == 1)
										<a href="#" class="btn btn-info btn-sm" disabled="">Goals Submitted</a>

									@elseif($appraisal->sentFlag && $appraisal->status == 2)
										<a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm">View Goals</a>

									@elseif(!$appraisal->sentFlag && $appraisal->status == 3 || !$appraisal->sentFlag && $appraisal->status == 5)
										<a href="{{ route('appraisal.submitAppraisalSupervisor', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm">Submit Goals To Supervisor</a>
										|
										<a href="{{ route('appraisal.deleteAppraisal', ['id' => $appraisal->id]) }}" class="btn btn-danger btn-sm">Delete</a>

									@elseif($appraisal->sentFlag && $appraisal->status == 4)
										<a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm">View Goals</a>

									@elseif($appraisal->sentFlag && $appraisal->status == 6 && $appraisal->appraisalStatus == 1)
										<p><a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm mb">View Goals</a></p>
										<p><a href="{{ route('appraisal.viewAppraisal', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">View Appraisal</a></p>

									@elseif($appraisal->sentFlag && $appraisal->status == 6 && $appraisal->appraisalStatus == 0 && $appraisal->startAppraisalFlag == 0)
										<p><a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm mb">View Goals</a></p>
										<p><a href="{{ route('appraisal.staffAppraisalCreate', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Start Appraisal</a></p>
										<p><a href="{{ route('appraisal.staffAppraisalSubmitSupervisor', ['id' => $appraisal->id]) }}" class="btn btn-success btn-sm">Submit Appraisal To Supervisor</a></p>

									@elseif($appraisal->sentFlag && $appraisal->status == 6 && $appraisal->appraisalStatus == 0 && $appraisal->startAppraisalFlag == 1)
										<p><a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm mb">View Goals</a></p>
										<p><a href="{{ route('appraisal.staffAppraisalEdit', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Edit Appraisal</a></p>
										<p><a href="{{ route('appraisal.staffAppraisalSubmitSupervisor', ['id' => $appraisal->id]) }}" class="btn btn-success btn-sm">Submit Appraisal To Supervisor</a></p>

									@elseif($appraisal->sentFlag && $appraisal->status == 6 && $appraisal->appraisalStatus == 3)
										<p><a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm mb">View Goals</a></p>
										<p><a href="{{ route('appraisal.staffAppraisalEdit', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Edit Appraisal</a></p>
										<p><a href="{{ route('appraisal.staffAppraisalSubmitSupervisor', ['id' => $appraisal->id]) }}" class="btn btn-success btn-sm">Submit Appraisal To Supervisor</a></p>

									@elseif($appraisal->sentFlag && $appraisal->status == 6 && $appraisal->appraisalStatus == 2)
										<p><a href="{{ route('appraisal.viewGoals', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm mb">View Goals</a></p>
										<p><a href="{{ route('appraisal.viewAppraisal', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">View Appraisal</a></p>

									@else
										<p><a href="{{ route('appraisal.submitAppraisalSupervisor', ['id' => $appraisal->id]) }}" class="btn btn-info btn-sm">Submit Goals To Supervisor</a></p>
										<p><a href="{{ route('appraisal.editAppraisal', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">Edit Goals</a></p>
										<p><a href="{{ route('appraisal.deleteAppraisal', ['id' => $appraisal->id]) }}" class="btn btn-danger btn-sm">Delete</a></p>
									@endif

								</td>
								<td class="v-align-middle">

									@if($appraisal->status == 0)
										<p>Not Submitted.</p>

									@elseif($appraisal->status == 1)
										<p>Submitted, awaiting supervisor's feedback.</p>

									@elseif($appraisal->status == 2)
										<p>Approved by {{ $appraisal->staff->supervisor->getFullNameAttribute() }}</p>

									@elseif($appraisal->status == 3)
										<p>
											Rejected, by {{ $appraisal->staff->supervisor->getFullNameAttribute() }}
											<br><br>
											<a href="{{ route('appraisal.rejectedGoals', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">
												View Comment
											</a>
										</p>

									@elseif($appraisal->status == 4)
										<p>Approved by {{ $appraisal->staff->supervisor->getFullNameAttribute() }}, sent to HR</p>

									@elseif($appraisal->status == 5)
										<p>
											Rejected, by HR
											<br><br>
											<a href="{{ route('appraisal.rejectedGoals', ['id' => $appraisal->id]) }}" class="btn btn-primary btn-sm">
												View Comment
											</a>
										</p>

									@elseif($appraisal->status == 6)
										<p>Approved by HR</p>

									@endif

								</td>
								<td class="v-align-middle">

									@if($appraisal->appraisalStatus == 1)
										<p>Appraisal Submitted, Awaiting Supervisor's approval.</p>

									@elseif($appraisal->appraisalStatus == 2)
										<p>Appraisal Approved by {{ $appraisal->staff->supervisor->getFullNameAttribute() }}.</p>

									@elseif($appraisal->appraisalStatus == 3)
										<p>Appraisal Rejected by {{ $appraisal->staff->supervisor->getFullNameAttribute() }}.</p>

									@else($appraisal->status == 6)
										<p>Not yet Started</p>

									@endif

								</td>
							</tr>

						@endforeach

						</tbody>
					</table>
				</div>
			</div>

		@else

			<h4 style="padding: 30px;">No appraisal yet!</h4>

		@endif

	</div>

	<div class="modal fade" id="supervisorCommentModal" tabindex="-1" role="dialog" aria-labelledby="supervisorCommentModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="supervisorCommentModalLabel">Comment/Reason</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="supervisorComment">Comment</label>
							<input class="form-control" name="supervisorComment" id="supervisorComment">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')

	@if(Session::has('success'))
		<script>
            toastr.success("{{ Session::get('success') }}")
		</script>
	@endif

	@if(Session::has('errorFlag'))
		<script>
            toastr.error("{{ Session::get('errorFlag') }}")
		</script>
	@endif

	@if(count($errors) > 0)
		<script>
			@foreach($errors->all() as $error)

            toastr.error("{{ $error }}");

			@endforeach
		</script>
	@endif

	<script>

        $(document).on("click", ".commentDialog", function () {

            let supervisorComment = $(this).data('comment');

            // console.log(supervisorComment)

            $("#supervisorComment").val( supervisorComment );

        });

	</script>

@endpush