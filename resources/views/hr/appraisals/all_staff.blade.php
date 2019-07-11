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

			<div class="card-box">
				<div class="panel-heading">
					<div class="panel-title">All Staff Appraisals for {{ $period }}
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					<form role="form" action="{{ route('appraisal.hrAllStaffAppraisals') }}" method="post">
						@csrf
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Select Period</label>
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

					@if(count($appraisals) > 0)

						<div style="margin-top: 30px;margin-bottom: 30px;">
							<table class="table table-hover nowrap" id="tableWithExportOptions">
								<thead>
								<tr>
									<th style="width:15%">Staff</th>
									<th style="width:10%">Picture</th>
									<th style="width:15%">Supervisor</th>
									<th style="width:10%">Position</th>
									<th style="width:5%">Staff <br> BSC Total</th>
									<th style="width:5%">Staff <br> Behavioral Total</th>
									<th style="width:5%">Staff <br> Overall Total</th>
									<th style="width:5%">Supervisor <br> BSC Total</th>
									<th style="width:5%">Supervisor <br> Behavioral Total</th>
									<th style="width:5%">Supervisor <br> Overall Total</th>
									<th style="width:10%">Department</th>
									<th style="width:10%">Location</th>
								</tr>
								</thead>
								<tbody>

								@foreach($appraisals as $appraisal)

									<tr>
										<td>
											<p>{{ $appraisal->staff->user->getFullNameAttribute() }}</p>
										</td>
										<td>
											<img src="{{ asset($appraisal->staff->user->avatar) }}" alt="{{ $appraisal->staff->user->avatar }}">
										</td>
										<td >
											<p>{{ $appraisal->staff->supervisor->getFullNameAttribute() }}</p>
										</td>
										<td>
											<p>{{ $appraisal->staff->position->Position }}</p>
										</td>
										<td>
											<p>{{ $appraisal->bscStaffScore }}</p>
										</td>
										<td>
											<p>{{ $appraisal->staffBehavioural }}</p>
										</td>
										<td>
											<p>{{ $appraisal->overallStaffScore }}</p>
										</td>
										<td>
											<p>{{ $appraisal->bscSupervisorScore }}</p>
										</td>
										<td>
											<p>{{ $appraisal->supervisorBehavioural }}</p>
										</td>
										<td>
											<p>{{ $appraisal->overallSupervisorScore }}</p>
										</td>
										<td>
											<p>{{ $appraisal->staff->department->Department }}</p>
										</td>
										<td>
											<p>{{ $appraisal->staff->location->Location }}</p>
										</td>
									</tr>

								@endforeach

								@else
									<tr>
										<td>No Appraisal has been approved yet!</td>
									</tr>

								</tbody>
							</table>
						</div>

					@endif

				</div>

			</div>

		</div>
	</div>
	<!-- END PAGE CONTENT -->

@endsection

@push('scripts')

	<script src="{{ asset('main/assets/js/tables.js') }}" type="text/javascript"></script>

	<script src="{{ asset('main/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript"></script>
	<script type="text/javascript" src="{{ asset('main/assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
	<script type="text/javascript" src="{{ asset('main/assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>

	<script src="{{ asset('main/assets/js/datatables.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/js/scripts.js') }}" type="text/javascript"></script>

@endpush