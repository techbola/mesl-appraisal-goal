@extends('layouts.master')
@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<a class="btn btn-info btn-rounded" href="{{ route('risk-register.create') }}">New Risk Register</a>
	{{-- </div> --}}
@endsection
@section('content')
{{-- <div class="container-fluid container-fixed-lg"> --}}
	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Risk Registers Listing
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
			<table class="table tableWithSearch table-striped table-bordered">
				<thead>
					<th>Risk Description</th>
					<th>Related Objectives</th>
					<th>Risk Score</th>
					<th>Risk Rating</th>
					<th>Control Eff. Score</th>
					<th>Control Eff. Rating</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($risk_registers as $rr)
					<tr>
						<td>{{ $rr->RiskDescription }}</td>
						<td>{{ $rr->RelatedObjectives }}</td>
						<td>{{ $rr->RiskScore }}%</td>
						<td>
							@if($rr->RiskScore >= 80)
							<label class="label label-danger">{{ $rr->RiskRating }}</label>
							@elseif($rr->RiskScore > 50)
							<label class="label label-warning">{{ $rr->RiskRating }}</label>
							@elseif($rr->RiskScore > 20)
							<label class="label label-info">{{ $rr->RiskRating }}</label>
							@elseif($rr->RiskScore <= 20)
							<label class="label label-success">{{ $rr->RiskRating }}</label>
							@endif
						</td>
						<td>{{ $rr->ControlEffectivenessScore }}%</td>
						<td>
							@if($rr->ControlEffectivenessScore >= 70)
							<label class="label label-danger">{{ $rr->ControlEffectivenessRating }}</label>
							@elseif($rr->ControlEffectivenessScore >= 50)
							<label class="label label-warning">{{ $rr->ControlEffectivenessRating }}</label>
							@else
							<label class="label label-success">{{ $rr->ControlEffectivenessRating }}</label>
							@endif
						</td>
						<td class="actions">
							<a href="{{ route('risk-registers.edit',[$rr->RiskRegisterRef]) }}" class="btn btn-xs btn-inverse">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
	<!-- END PANEL -->
{{-- </div> --}}
@endsection

