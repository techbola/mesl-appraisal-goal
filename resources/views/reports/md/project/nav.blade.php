@section('buttons')
<a href="{{ route('admin-home') }}" class="btn btn-complete">Dashboard</a>
@endsection
<section id="summary" class="dashblocks dashblocks-sm m-b-20">

	<div class="row">
		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
				<a href="{{ route('project.overall') }}">
					<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/summary.png') }}" alt="">
						<h6 class="bold theme-primary">Overall Project Summary - Completed &amp; Ongoing</h6>
					</div>
				</a>
			</div>
		</div>

		

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('project.performance') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/graph.png') }}" alt="">
						<h6 class="bold theme-primary">Project Performance Gragh - Budget & Timeline</h6>
					</div>
				</a>
			</div>
		</div>

		<div class="col-sm-3 text-center">
			<div class="panel panel-info">
					<a href="{{ route('project.individual') }}">
						<div class="panel-heading">
						<img src="{{ asset('assets/img/icons/project.png') }}" alt="">
						<h6 class="bold theme-primary">Individual Project Details Report</h6>
					</div>
				</a>
			</div>
		</div>

	</div>

</section>
