@extends('layouts.main.master')

@push('styles')

	<link href="{{ asset('main/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('main/assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />

@endpush

@section('content')

	<!-- START PAGE CONTENT -->
	<div class="content ">
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg bg-white" id="staffScoreReport">
			<!-- START PANEL -->
			<div class="panel panel-transparent">
				<div class="panel-heading">
					<div class="panel-title">

						<h2>Score Report for {{ $data['staffName'] }}</h2>

						Period - {{ $data['period'] }}

					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">

					<h5>Behavioural Score Card</h5>

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
									<p>{{ $data['staffFinancial'] }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $data['supervisor_financial'] }}</p>
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
									<p>{{ $data['staffCustomer'] }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $data['supervisor_customer'] }}</p>
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
									<p>{{ $data['staffInternal'] }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $data['supervisor_internal'] }}</p>
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
									<p>{{ $data['staffLearning'] }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $data['supervisor_learning'] }}</p>
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
									<p>{{ $data['bscStaffScore'] }}</p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $data['bscSupervisorScore'] }}</p>
								</td>
							</tr>

							<tr>
								<td class="v-align-middle ">
									<p><strong>Attitudinal Total (10%)</strong></p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $data['staffBehavioural'] }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $data['supervisorBehavioural'] }}</p>
								</td>
							</tr>

							<tr>
								<td class="v-align-middle ">
									<p><strong>Overall Total (100%)</strong></p>
								</td>
								<td class="v-align-middle ">
									<p>{{ $data['overallStaffScore'] }}</p>
								</td>
								<td class="v-align-middle">
									<p>{{ $data['overallSupervisorScore'] }}</p>
								</td>
							</tr>

							</tbody>
						</table>
					</div>

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