@extends('layouts.master')

@push('styles')

	<link href="{{ asset('main/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />

@endpush

@section('content')

	<!-- START PAGE CONTENT -->
	<div class="">
		<!-- START CONTAINER FLUID -->
		<div class="">
			<!-- START PANEL -->
			<div class="card-box">
				<div class="panel-heading">
					<div class="panel-title">Select Period
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					<form role="form" action="{{ route('appraisal.hrAllStaffAppraisals') }}" method="post">
						@csrf
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Appraisal Period</label>
									<select name="appraiser_period" id="appraiser_period" class="full-width" style="height: 50px;">
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
						<button class="btn btn-primary" type="submit">Submit</button>
					</form>
				</div>
			</div>
			<!-- END PANEL -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->

@endsection

@push('scripts')

	<script src="{{ asset('main/assets/js/tables.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/js/scripts.js') }}" type="text/javascript"></script>

@endpush