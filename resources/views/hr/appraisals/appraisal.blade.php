@extends('layouts.master')

@section('content')

	<!-- START PAGE CONTENT -->
	<div class=" ">
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg">

			<h4><strong>{{ $staffName }}</strong></h4>

			<form action="{{ route('appraisal.hrGoalsApproval', ['appraisalID' => $appraisalID]) }}" method="post">
				@csrf

				<div id="rootwizard" class="m-t-50">
					<!-- Nav tabs -->
				@include('hr.appraisals.includes.appraisal_nav')
				<!-- Tab panes -->

					<div class="tab-content">

						@include('hr.appraisals.includes.bsc_financial')
						@include('hr.appraisals.includes.bsc_customer')
						@include('hr.appraisals.includes.bsc_internal')
						@include('hr.appraisals.includes.bsc_learning')
						@include('hr.appraisals.includes.staff_behavioural')
						@include('hr.appraisals.includes.others')

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