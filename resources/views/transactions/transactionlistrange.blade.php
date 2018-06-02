@extends('layouts.master')

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
				<div class="panel-title">
					Transaction List
				</div>
				<div class="pull-right">
					<div class="col-xs-12">
						<input type="text" class="search-table form-control pull-right" placeholder="Search">
					</div>
				</div>
				<div class="clearfix"></div>
			<div class="panel-body">
				<table class="table tableWithSearch">
					<thead>
                        <th>Ref</th>
						<th>Account Number</th>
                        <th>Customer Details</th>
                        <th>Post Date</th>
						<th>Value Date</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Balance</th>       
                        <th>Naration</th>
                        <th>Input</th>
                        <th>Input Date</th>
                        <th>Transaction Code</th>
                    </thead>
                    <tbody>
                        @foreach($trans as $tran)
                        <tr>
                            <td>{{$tran->TransactionRef}}</td>
                            <td>{{$tran->AccountNumber}}</td>
                            <td>{{$tran->Details}}</td>
                            <td>{{$tran->PostDate}}</td>
                            <td>{{$tran->ValueDate}}</td>
                            <td>{{number_format($tran->Debit, 2)}}</td>
                            <td>{{number_format($tran->Credit, 2)}}</td>
                            <td>{{number_format($tran->Balance, 2)}}</td>
                            <td>{{$tran->Narration}}</td>
                            <td>{{$tran->InputterID}}</td>
                            <td>{{$tran->InputDatetime}}</td>
                            <td>{{$tran->TransactionCode}}</td>
                        </tr>
                        @endforeach
                    </tbody>
				</table>
			</div>
		</div>
		<!-- END PANEL -->
	</div>
	@endsection

