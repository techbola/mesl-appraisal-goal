@extends('layouts.master')

@section('content')

	<!-- START PAGE CONTENT -->
	<div class=" ">
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg">

			<div id="rootwizard" class="m-t-50">
				<!-- Nav tabs -->
					@include('supervisor.goals.view_goals.includes.appraisal_nav')
				<!-- Tab panes -->

				<div class="tab-content">

					@include('supervisor.goals.view_goals.includes.bsc_financial')
					@include('supervisor.goals.view_goals.includes.bsc_customer')
					@include('supervisor.goals.view_goals.includes.bsc_internal')
					@include('supervisor.goals.view_goals.includes.bsc_learning')
					@include('supervisor.goals.view_goals.includes.staff_behavioural')
					@include('supervisor.goals.view_goals.includes.others')

					<div class="padding-20">
						<ul class="pager wizard">
							<li class="next">
								<button class="btn btn-orange pull-right" type="button">
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

	<script src="{{ asset('main/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/js/form_wizard.js') }}" type="text/javascript"></script>

@endpush