@extends('layouts.master')
@push('styles')
<style>
.shadow{
	-webkit-box-shadow: 10px 7px 8px -6px rgba(179,179,179,0.79);
-moz-box-shadow: 10px 7px 8px -6px rgba(179,179,179,0.79);
box-shadow: 10px 7px 8px -6px rgba(179,179,179,0.79);
}
</style>

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			<h2>Daily Report</h2>
		</div><hr>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4" style="padding: 20px">
				<div class="shadow" style="padding: 20px; background: #eee">
					<h4 class="text-primary">Registered Patient</h4><hr>
						
						<p><span class="badge badge-primary ">1</span>&nbsp &nbsp Magodo Patient <span class="label label-inverse pull-right">{{ $registeredpatientMagodo }}</span></p><div class="clearfix"></div><hr>

						<p><span class="badge badge-primary ">2</span>&nbsp &nbsp Victoria Island Patient <span class="label label-warning pull-right">{{ $registeredpatientVI }}</span></p><div class="clearfix"></div><hr>

						<p><span class="badge badge-primary ">3</span>&nbsp &nbsp CMD Patient <span class="label label-success pull-right">{{ $registeredpatientVI }}</span></p><div class="clearfix"></div><hr>

						<p><span class="badge badge-primary ">4</span>&nbsp &nbsp Total Patient Registered <span class="label label-info pull-right">{{ $registeredpatienttoday }}</span></p><div class="clearfix"></div><hr>
				</div>
			</div>
			<div class="col-md-4" style="padding: 20px">
				<div class="shadow" style="padding: 20px; background: #e3dff0">
					<h4 class="text-primary">Daily Revenue</h4><hr>

					<p><span class="badge badge-danger ">1</span>&nbsp &nbsp Magodo Branch <span class="label label-inverse pull-right">&#8358;{{ number_format($incomeMagodo,2) }}</span></p><div class="clearfix"></div><hr>

					<p><span class="badge badge-danger ">2</span>&nbsp &nbsp Victoria Island Branch <span class="label label-inverse pull-right">&#8358;{{ number_format($incomeVI,2) }}</span></p><div class="clearfix"></div><hr>

					<p><span class="badge badge-danger">4</span>&nbsp &nbsp CMD Branch <span class="label label-inverse pull-right">&#8358;{{ number_format($incomeCMD,2) }}</span></p><div class="clearfix"></div><hr>

					<p><span class="badge badge-danger">5</span>&nbsp &nbsp Total Income Today <span class="label label-success pull-right">&#8358;{{ number_format($dailyAmountpaid,2) }}</span></p><div class="clearfix"></div><hr>
				</div>
			</div>
			<div class="col-md-4" style="padding: 20px">
				<div class="shadow" style="padding: 20px; background: #8ac9b7">
					<h4 class="text-primary">Today's Outstanding</h4><hr>

					<p><span class="badge badge-info">1</span>&nbsp &nbsp Total Outstanding  <span class="label label-warning pull-right">&#8358;48,000</span></p><div class="clearfix"></div><hr>

				</div>

				<div class="shadow" style="padding: 20px; background: #c98ac4; margin-top: 20px">
					<h4 class="text-primary">Outstanding Per Branch</h4><hr>

					<p><span class="badge badge-info">1</span>&nbsp &nbsp Total Outstanding  <span class="label label-warning pull-right">&#8358;48,000</span></p><div class="clearfix"></div><hr>

				</div>
			</div>
	    </div>
    </div>
@endsection

