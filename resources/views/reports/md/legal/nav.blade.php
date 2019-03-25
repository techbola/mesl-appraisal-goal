@section('buttons')
<a href="{{ route('admin-home') }}" class="btn btn-complete">Dashboard</a>
@endsection
<section id="summary" class="dashblocks dashblocks-sm m-b-20">

	<div class="row">
		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
				<a href="{{ route('legal.company-secretariat') }}">
					<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/summary.png') }}" alt="">
						<h6 class="bold theme-primary">Company Secretariat Report</h6>
					</div>
				</a>
			</div>
		</div>

		

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('legal.regulatory') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/regulatory.png') }}" alt="">
						<h6 class="bold theme-primary">Regulatory Report</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('legal.legal-contract') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/contract.png') }}" alt="">
						<h6 class="bold theme-primary">Legal Contract Summary</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('legal.litigation') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/legal.png') }}" alt="">
						<h6 class="bold theme-primary">Litigation Cases</h6>
					</div>
				</a>
			</div>
		</div>

	</div>

</section>
