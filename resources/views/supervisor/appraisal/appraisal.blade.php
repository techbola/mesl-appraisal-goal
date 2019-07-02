@extends('layouts.master')

@section('content')

	<!-- START PAGE CONTENT -->
	<div class=" ">
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg">

			<h4><strong>{{ $staffName }}</strong></h4>

			<form action="{{ route('appraisal.staffAppraisalApproval', ['appraisalID' => $appraisalID]) }}" method="post">
				@csrf

				<div id="rootwizard" class="m-t-50">
					<!-- Nav tabs -->
				@include('supervisor.appraisal.includes.appraisal_nav')
				<!-- Tab panes -->

					<div class="tab-content">

						@include('supervisor.appraisal.includes.bsc_financial')
						@include('supervisor.appraisal.includes.bsc_customer')
						@include('supervisor.appraisal.includes.bsc_internal')
						@include('supervisor.appraisal.includes.bsc_learning')
						@include('supervisor.appraisal.includes.staff_behavioural')
						@include('supervisor.appraisal.includes.others')

						@if($ap->status != 4 && $ap->status != 2 && $ap->appraisalStatus != 2)
						<div class="row row-same-height" style="margin-top: -50px;">
							<div class="col-md-12">
								<div class="card-box">
									<div class="panel-body">
										<div class="form-group">
											<input type="hidden" name="appraisalID" value="{{ $appraisalID }}">
											<input type="hidden" name="behaviourals" value="{{ $behaviourals->pluck('id') }}">
											<button type="submit" class="btn btn-danger pull-left" name="action" value="reject">Reject & Send to Staff</button>
											<button type="submit" class="btn btn-primary pull-left" name="action" value="approve" style="margin-left: 30px;">Approve</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						@endif

						<div class="padding-20">
							<ul class="pager wizard">
								<li class="next">
									<button class="btn btn-primary pull-right" type="button">
										<span>Next</span>
									</button>
								</li>
								<li class="previous">
									<button class="btn btn-default pull-right" type="button">
										<span>Previous</span>
									</button>
								</li>
							</ul>
						</div>

					</div>

				</div>


			</form>

		</div>
		<!-- END CONTAINER FLUID -->
	</div>
	<!-- END PAGE CONTENT -->

@endsection

@push('scripts')

	@if(Session::has('success'))
		<script>
            toastr.success("{{ Session::get('success') }}")
		</script>
	@endif

	@if(Session::has('error'))
		<script>
            toastr.error("{{ Session::get('error') }}")
		</script>
	@endif

	@if(count($errors) > 0)
		<script>
			@foreach($errors->all() as $error)

            toastr.error("{{ $error }}");

			@endforeach
		</script>
	@endif

@endpush