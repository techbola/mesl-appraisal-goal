@section('buttons')
<a href="{{ route('admin-home') }}" class="btn btn-complete">Dashboard</a>
@endsection
<section id="summary" class="dashblocks dashblocks-sm m-b-20">

	<div class="row">
		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
				<a href="{{ route('md.plant-report') }}">
					<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/plant.png') }}" alt="">
						<h6 class="bold theme-primary">Plant Report</h6>
					</div>
				</a>
			</div>
		</div>

		

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('md.admin-report') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/admin.png') }}" alt="">
						<h6 class="bold theme-primary">Admin Report</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('md.procurement-report') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/procurement.png') }}" alt="">
						<h6 class="bold theme-primary">Procurement Report</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('md.ict-report') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/ict.png') }}" alt="">
						<h6 class="bold theme-primary">ICT Report</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="clearfix"></div>

		

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('md.account-finance-scorecard') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/accounting.png') }}" alt="">
						<h6 class="bold theme-primary">Accounting & Finance Scorecard</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('md.business-risk-control-report') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/risk.png') }}" alt="">
						<h6 class="bold theme-primary">Business Risk & Control Report</h6>
					</div>
				</a>
			</div>
		</div>



		{{-- <div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="">
						<div class="panel-heading">
						<img src="" alt="">
						<h6 class="bold theme-primary">Bank Accounts</h6>
					</div>
				</a>
			</div>
		</div> --}}

	</div>

</section>
