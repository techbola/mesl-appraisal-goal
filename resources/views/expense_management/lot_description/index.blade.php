@extends('layouts.master')
@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<a class="btn btn-info btn-rounded" href="{{ route('lot_description.create') }}">New Lot Description</a>
	{{-- </div> --}}
@endsection
@section('content')
{{-- <div class="container-fluid container-fixed-lg"> --}}
	<!-- START PANEL -->
	<div class="card-box">    
		<div class="card-title pull-left">
			Lot Description
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
			<div class="table-responsive">
				<table class="table tableWithSearch table-striped">
				<thead>
					<th>Lot Description</th>
					<th>Deparment</th>
					<th>Expense Category</th>
					<th>Annual Budget</th>
					<th>Monthly Budget</th>
					<th>Amount Spent</th>
					<th>Balance</th>
					<th>MTD Actual</th>
					<th>YTD Actual</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach ($lot_descriptions as $ld)
					<tr>
						<td>{{ $ld->LotDescription }}</td>
						<td>{{ $ld->department->name ?? '-' }}</td>
						<td>{{ $ld->expense_category->ExpenseCategory ?? '-' }}</td>
						<td>{{ number_format($ld->AnnualBudget, 2) }}</td>
						<td>{{ number_format($ld->MonthlyBudget, 2) }}</td>
						<td>{{ number_format($ld->AmountSpent, 2) }}</td>
						<td>{{ number_format($ld->Balance, 2) }}</td>
						<td>{{ number_format($ld->MTDActual, 2) }}</td>
						<td>{{ number_format($ld->YTDActual, 2) }}</td>	
						<td>
							<a href="{{ route('lot_description.edit', [$ld->LotDescriptionRef]) }}" class="btn btn-primary">Edit</a>
						</td>					
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
	</div>
	<!-- END PANEL -->
{{-- </div> --}}
@endsection

