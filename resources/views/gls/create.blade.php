@extends('layouts.master')

@section('content')
<div class="card-box">
		<div class="card-title">
			Create General Ledger
		</div>
		{{ Form::open(['action' => 'GLController@store', 'role' => 'form']) }}
		@include('gls.form', ['buttonText' => 'Create GL'])
		{{ Form::close() }}
</div>
@endsection

{{-- @section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			GLs Listing
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
			<table class="table tableWithSearch table-striped table-bordered">
				<thead>
					<th>Customer Ref</th>
					<th>Customer</th>
					<th>Account Type</th>
					<th>Currency</th>
					<th>Branch</th>
					<th>AccountNo</th>
					<th>BookBalance</th>
					<th>Description</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($gls as $gl)
					<tr>
						<td>{{ $gl->GLRef }}</td>
						<td>{{ $gl->Customer }}</td>
						<td>{{ $gl->AccountType }}</td>
						<td>{{ $gl->Currency}}</td>
						<td>{{ $gl->Branch }}</td>
						<td>{{ $gl->AccountNo }}</td>
						<td>{{ $gl->BookBalance }}</td>
						<td>{{ $gl->Desc ?? '-'}}</td>
						<td class="actions">
							<a href="{{ route('gls.edit',[$gl->GLRef]) }}" class="btn btn-xs btn-inverse">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
	<!-- END PANEL -->
</div>
@endsection --}}
