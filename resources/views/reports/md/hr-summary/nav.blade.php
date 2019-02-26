@section('buttons')
<a href="{{ route('admin-home') }}" class="btn btn-complete">Dashboard</a>
@endsection
<section id="summary" class="dashblocks dashblocks-sm m-b-20">

	<div class="row">
		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
				<a href="{{ route('hr-summary.department') }}">
					<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/department.png') }}" alt="">
						<h6 class="bold theme-primary">Staff Summary by Department</h6>
					</div>
				</a>
			</div>
		</div>

		

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('hr-summary.level') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/summary.png') }}" alt="">
						<h6 class="bold theme-primary">Staff Summary by Level</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('hr-summary.leave-utilization') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/graph.png') }}" alt="">
						<h6 class="bold theme-primary">Leave Utilization Graph per month Report</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('hr-summary.staff-attrition') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/attrition.png') }}" alt="">
						<h6 class="bold theme-primary">Staff Attrition Rate Report</h6>
					</div>
				</a>
			</div>
		</div>

	</div>

</section>
