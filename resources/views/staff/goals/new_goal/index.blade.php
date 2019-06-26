@extends('layouts.master')

@section('content')

	<div class="">

		<!-- START CONTAINER FLUID -->
		<div class="card-box">

			<div class="row">
				<div class="col-lg-8 col-md-6 ">
					<!-- START PANEL -->
					<div class="">
						<div class="panel-body">
							<form role="form" action="{{ route('appraisal.staff_details.store') }}" method="post">
								@csrf
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Employee Name</label>
											<input type="text" class="form-control" name="employee_name" value="{{ auth()->user()->last_name . ' ' .auth()->user()->first_name }}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Job Position</label>
											<input type="text" class="form-control" name="job_position" value="{!! ucwords(Auth::user()->roles()->first()->name) !!}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Department</label>
											<input type="text"  class="form-control" name="department" value="{{ auth()->user()->staff->department->Department }}" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Appraisal Period</label>
											<select name="appraiser_period" id="appraiser_period" class="full-width form-control" data-init-plugin="select2" style="height: 50px;">
												<option value="2018/2019">2018/2019</option>
												<option value="2019/2020">2019/2020</option>
												<option value="2020/2021">2020/2021</option>
												<option value="2021/2022">2021/2022</option>
												<option value="2022/2023">2022/2023</option>
												<option value="2023/2024">2023/2024</option>
												<option value="2024/2025">2024/2025</option>
												<option value="2025/2026">2025/2026</option>
												<option value="2026/2027">2026/2027</option>
												<option value="2027/2028">2027/2028</option>
												<option value="2028/2029">2028/2029</option>
												<option value="2029/2030">2029/2030</option>
											</select>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-sm-12">
										<button class="btn btn-orange" type="submit">Next</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END PANEL -->
				</div>

			</div>

		</div>
		<!-- END CONTAINER FLUID -->

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

@endpush