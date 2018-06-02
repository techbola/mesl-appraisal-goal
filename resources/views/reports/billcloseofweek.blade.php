@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			<h2>Report For <span class="text-primary">{{$mon}}</span> - <span class="text-primary">{{ $mon }}</span></h2>
		</div><hr>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-4 bg-primary" style="color:#fff; padding: 30px">
				<h4 style="color:#fff;">Patient Registered : {{ $registeredpatientweekly }}</h4>
			</div>
			<div class="col-sm-4 bg-danger" style="color:#fff; padding: 30px">
				<h4 style="color:#fff;">Patient Registered Magodo : {{ $registeredpatientMagodoweekly }}</h4>
			</div>
			<div class="col-sm-4 bg-success" style="color:#fff; padding: 30px">
				<h4 style="color:#fff;">Patient Registered VI : {{  $registeredpatientVIweekly }}</h4>
			</div>	
		</div><br>
		<div class="row">
			<div class="col-sm-5 bg-complete" style=" padding: 30px">
				<table class="table">
					<caption style="color: #000"><b>Total Amount Paid today in Both Branches</b></caption>
					<thead>
							<th style="color:#fff">S/N</th>
							<th style="color:#fff">Amount(Paid)</th>
							<th style="color:#fff">Action</th>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td style="color: green"><b>&#8358;{{ number_format($weeklyAmountpaid, 2) }}</b></td>
							<td><a href="" class="btn btn-xs btn-rounded btn-primary">View</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-5 bg-info" style="color:#fff; padding: 30px">
				<table class="table" boarder="1">
					<caption style="color: #fff"><b>Total Outstanding Today</b></caption>
					<thead>
							<th style="color:#fff">S/N</th>
							<th style="color:#fff">Outstanding</th>
							<th style="color:#fff">Action</th>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td style="color: red"><b>&#8358;{{ number_format($weeklyOutstanding, 2) }}</b></td>
							<td><a href="" class="btn btn-xs btn-rounded btn-primary">View</a></td>
						</tr>
					</tbody>
				</table>
			</div>
				
		</div>
	</div>
</div>
@endsection

