@extends('layouts.master')

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent" id="print_only">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-6">
					<h3>Account Statement.</h3>
				</div>
				<div class="col-md-6">
					<span class="pull-right"><button onclick="printDoc('print_only')" id="printbutton" class="btn btn-complete">Print Statement</button></span>
				</div>
			</div><div class="clearfix"></div><hr>
		</div>
		<div class="panel-body">
			<div class="row" style="padding: 30px">
				<table>
					@if(isset($statements))
					@foreach($statements as $statement)
					<tbody>
						<tr>
							<td width="10%"><p style ="font-size :17px">Name :</p></td>
							<td width="50%"><p style ="font-size :17px; color : #0090d9"">{{$statement->Customer}}</p></td>
							<td width="20%"><p style ="font-size :17px">Account No :</p></td>
							<td width="20%"><p style ="font-size :17px; color : #0090d9">{{$statement->AccountNumber}}</p></td>
						</tr>
						<tr>
							<td width="20%"><p style ="font-size :17px">Address :</p></td>
							<td width="40%">
								@if($statement->HomeAddress)
								<p style ="font-size :17px; color : #0090d9">{{$statement->HomeAddress}}</p>
								@endif
							</td>
							<td width="20%"><p style ="font-size :17px">Account Type :</p></td>
							<td width="20%"><p style ="font-size :17px; color : #0090d9">{{$statement->AccountType}}</p></td>
						</tr>
						<tr>
							<td width="20%"><p style ="font-size :17px">Phone Number :</p></td>
							<td width="40%">
							@if($statement->Telephone)
								<p style ="font-size :17px; color : #0090d9">{{$statement->Telephone}}</p>
							@endif
							</td>
							<td width="20%"><p style ="font-size :17px">Currency :</p></td>
							<td width="20%"><p style ="font-size :17px; color : #0090d9">{{$statement->Currency}}</p></td>
						</tr>
						<tr>
							<td width="20%"><p style ="font-size :17px">BVN Number :</p></td>
							<td width="40%">
								@if($statement->BVN)
								<p style ="font-size :17px; color : #0090d9">{{$statement->BVN}}</p>
								@endif
							</td>
							<td width="20%"><p style ="font-size :17px">Book Balance :</p></td>
							<td width="20%"><p style ="font-size :17px; color : #0090d9">{{ number_format( $statement->BookBalance,2)}}</p></td>
						</tr>
						<tr>
							<td width="20%"></td>
							<td width="40%"></td>
							<td width="20%"><p style ="font-size :17px">Cleared Balance :</p></td>
							<td width="20%"><p style ="font-size :17px; color : #0090d9">{{ number_format( $statement->ClearedBalance,2)}}</p></td>
						</tr>
					</tbody>
					@endforeach
					@endif
				</table>
			</div>
			<table class="table table-bordered">
				<thead>
					<th>Transaction Date</th>
					<th>Value Date</th>
					<th>Debits</th>
					<th>Credits</th>
					<th>Balance</th>
					<th>Naration</th>
				</thead>
				<tbody>
				@if(isset($trans))
					@foreach($trans as $tran)
					<tr>
						<td style="padding: 10px">{{$tran->PostDate}}</td>
						<td style="padding: 10px">{{$tran->ValueDate}}</td>
						<td style="padding: 10px">{{number_format($tran->Debit,2) }}</td>
						<td style="padding: 10px">{{number_format($tran->Credit,2) }}</td>
						<td style="padding: 10px">{{number_format($tran->Balance,2) }}</td>
						<td style="padding: 10px">{{$tran->Narration}}</td>
					</tr>
					@endforeach
				@endif
				</tbody>
			</table>
		</div>
	</div><br><br>
	<!-- END PANEL -->

	@endsection

	 @push('scripts')
       
    <script>
       function printDoc(el){
       	var restorepage = document.body.innerHTML;
       	var printcontent = document.getElementById(el).innerHTML;
       	document.body.innerHTML = printcontent;
       	 var printButton = document.getElementById("printbutton");
       	 printButton.style.visibility = 'hidden';
       	window.print();
       	document.body.innerHTML = restorepage;
       }
    </script>
        @endpush

