@extends('layouts.master')
@push('styles')
<style type="text/css">
	.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    border-right: 2px solid;
}
</style>
@endpush
@section('content')

	<!-- START PAGE CONTENT -->
	<div class="">
		<!-- START CONTAINER FLUID -->
		<div class="card-box">

			<div id="rootwizard" class="m-t-50">
				<!-- Nav tabs -->
					@include('staff.goals.new_goal.includes.appraisal_nav')
				<!-- Tab panes -->

				<div class="tab-content">

					@include('staff.goals.new_goal.includes.bsc_financial')
					@include('staff.goals.new_goal.includes.bsc_customer')
					@include('staff.goals.new_goal.includes.bsc_internal')
					@include('staff.goals.new_goal.includes.bsc_learning')
					@include('staff.goals.new_goal.includes.staff_behavioural')
					@include('staff.goals.new_goal.includes.others')

					<div class="padding-20">
						<ul class="pager wizard">
							<li class="next" >
								<button class="btn btn-orange pull-right" type="button">
									<span>Next</span>
								</button>
							</li>
							<li class="previous">
								<button class="btn btn pull-right" type="button" style="margin-right: 10px">
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

	@include('staff.goals.new_goal.includes.edit_appraisal_modals')

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

	<script type="text/javascript" src="{{ asset('main/js/staff_add_row.js') }}"></script>

	<script type="text/javascript" src="{{ asset('main/js/delete_checkbox_ids.js') }}"></script>

	<script type="text/javascript" src="{{ asset('main/js/pass_appraisalid_to_modal.js') }}"></script>

@endpush