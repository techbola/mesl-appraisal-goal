<div class="tab-pane padding-20 active slide-left" id="tab1">
	<div class="row row-same-height">
		<div class="col-md-12">
			
			<form action="{{ route('staff_details.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				{{-- Employer Details --}}
				<div class="form-group-attached">
					<div class="row clearfix">
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Employee Name</label>
								<input type="text" class="form-control" name="employee_name" value="{{ auth()->user()->last_name . ' ' .auth()->user()->first_name }}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Job Position</label>
								<input type="text" class="form-control" name="job_position">
							</div>
						</div>
					</div>

					<div class="row clearfix">
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Department</label>
								<input type="text" class="form-control" name="department">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-group-default required">
								<label>Appraiser's Period</label>
								@if(!empty($appraisal_period))
									<input type="text" class="form-control" name="appraiser_period" value=" {{ $appraisal_period->period }}">
								@else
									<select name="appraiser_period" id="appraiser_period" class="form-control">
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
								@endif
							</div>
						</div>
					</div>

					@if(auth()->user()->staff->SupervisorFlag)
						<div class="row clearfix">
							<div class="col-sm-6">
								<div class="form-group form-group-default required">
									<label>Appraiser's Designation</label>
									<input type="text" class="form-control" name="appraiser_designation">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group form-group-default required">
									<label>Appraiser's Name</label>
									<input type="text" class="form-control" name="appraiser_name">
								</div>
							</div>
						</div>
					@endif

				</div>
				<br>

				<div class="form-group-attached">
					<div class="row clearfix">
						<div class="col-md-12">
							<button class="btn btn-primary btn-cons btn-animated" type="submit">
								<span>Submit & Click Next</span>
							</button>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>