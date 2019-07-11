@extends('layouts.master')

@push('styles')

	<link href="{{ asset('main/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />

@endpush

@section('content')

	<!-- START PAGE CONTENT -->
	<div class=" ">
		<!-- START CONTAINER FLUID -->
		<div class="" id="staffScoreReport">
			<!-- START PANEL -->
			<div class="card-box">
				<div class="panel-heading">
					<div class="panel-title">

						<h2>Score Report for {{ $ap->period }}</h2>

					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					<h5>Balance Score Card</h5>

					<div class="table-responsive">
						<table class="table table-hover" id="basicTable">
							<thead>
							<tr>
								<th style="width:30%">Summary</th>
								<th style="width:20%">Weight (%)</th>
								<th style="width:20%">Self Assessment (%)</th>
								<th style="width:25%">Supervisor's Assessment (%)</th>
							</tr>
							</thead>
							<tbody>

								<tr>
									<td class="v-align-middle ">
										<p><strong>Financial</strong></p>
									</td>
									<td class="v-align-middle ">
										<p>100</p>
									</td>
									<td class="v-align-middle ">
										<p>{{ $staffFinancial }}</p>
									</td>
									<td class="v-align-middle">
										<p>{{ $supervisor_financial }}</p>
									</td>
								</tr>

								<tr>
									<td class="v-align-middle ">
										<p><strong>Customer/Stakeholders</strong></p>
									</td>
									<td class="v-align-middle ">
										<p>100</p>
									</td>
									<td class="v-align-middle ">
										<p>{{ $staffCustomer }}</p>
									</td>
									<td class="v-align-middle">
										<p>{{ $supervisor_customer }}</p>
									</td>
								</tr>

								<tr>
									<td class="v-align-middle ">
										<p><strong>Internal Process</strong></p>
									</td>
									<td class="v-align-middle ">
										<p>100</p>
									</td>
									<td class="v-align-middle ">
										<p>{{ $staffInternal }}</p>
									</td>
									<td class="v-align-middle">
										<p>{{ $supervisor_internal }}</p>
									</td>
								</tr>

								<tr>
									<td class="v-align-middle ">
										<p><strong>People/Learning</strong></p>
									</td>
									<td class="v-align-middle ">
										<p>100</p>
									</td>
									<td class="v-align-middle ">
										<p>{{ $staffLearning }}</p>
									</td>
									<td class="v-align-middle">
										<p>{{ $supervisor_learning }}</p>
									</td>
								</tr>

							</tbody>
						</table>
					</div>

					<h5>Overall Score Card</h5>

					<div class="table-responsive">
						<table class="table table-hover" id="basicTable">
							<thead>
							<tr>
								<th style="width:40%"></th>
								<th style="width:20%">Self Assessment</th>
								<th style="width:20%">Supervisor's Assessment</th>
							</tr>
							</thead>
							<tbody>

							<tr>
								<td class="v-align-middle ">
									<p><strong>BSC Total (90%)</strong></p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $bscStaffScore }}</p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $bscSupervisorScore }}</p>
								</td>
							</tr>

							<tr>
								<td class="v-align-middle ">
									<p><strong>Behavioral Total (10%)</strong></p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $staffBehavioural }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $supervisorBehavioural }}</p>
								</td>
							</tr>

							<tr>
								<td class="v-align-middle ">
									<p><strong>Overall Total (100%)</strong></p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $overallStaffScore }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $overallSupervisorScore }}</p>
								</td>
							</tr>

							<tr>
								<td class="v-align-middle ">
									<p><strong>Performance Rating</strong></p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $selfPerformanceRating }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $supervisorPerformanceRating }}</p>
								</td>
							</tr>

							</tbody>
						</table>
					</div>

					<table>
						<tr>
							<td>
								<button class="btn btn-info btn-sm" onclick="printMe()">
									<i class="fa fa-print"></i>&nbsp; Print
								</button>
							</td>
							<td></td>
							<td>
								<a class="btn btn-primary btn-sm m-l-10" href="{{ route('appraisal.staff.downloadScoreReport', $ap->id) }}">
									<i class="fa fa-download"></i>&nbsp; Download
								</a>
							</td>
						</tr>
					</table>

				</div>
			</div>
			<!-- END PANEL -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->

@endsection

@push('scripts')

	<script src="{{ asset('main/assets/js/jquery-printme.js') }}"></script>
	<script>
		function printMe() {
            $("#staffScoreReport").printMe({
				"title": "Staff Performance Report",
                "path": ["/main/assets/css/staff_score_report.css"]
            });
        }
	</script>

	<script src="{{ asset('main/assets/js/tables.js') }}" type="text/javascript"></script>
	<script src="{{ asset('main/assets/js/scripts.js') }}" type="text/javascript"></script>

@endpush