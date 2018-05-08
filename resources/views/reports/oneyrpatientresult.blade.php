@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Search For Product(s) & Service(s) 
		</div>
	</div><br>
	<div class="panel-body">
   
		<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Bill Listing
			</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">

			<div class="row">
				<div class="col-md-12">
                <div class="sm-m-l-5 sm-m-r-5">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  	@foreach ($billresults as $billresult)
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h2 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $billresult->GroupID}}" aria-expanded="false" aria-controls="collapseOne" class="collapsed" style="font-weight: 600; font-size: 16px">
                             {{ $billresult->Fullname }}
                            </a>
                          </h2>
                      </div>
                      <div id="{{ $billresult->GroupID }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                          <table class="table">
							<thead>
								<tr>
									<th>Billing Date</th>
									<th>Category</th>
									<th>Service(s)</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total Price</th>
									<th>Outstanding</th>
									<th>Amount Paid</th>
								</tr>
							</thead>
							<tbody>
								@foreach(App\Billing::details($billresult->GroupID) as $d)
								<tr>
									<td>{{ $d->BillingDate }}</td>
									<td>{{ $d->ServiceDesc }}</td>
									<td>{{ $d->Produt_ServiceType }}</td>
									<td>{{ $d->Price }}</td>
									<td>{{ $d->Quantity }}</td>
									<td>{{ $d->QuantityPrice }}</td>
									<td style="color:red">{{ $d->AmountOutstanding }}</td>
									<td style="color:green">{{ $d->AmountPaid }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</tbody>
			       </table>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
			</div>

			{{-- <table class="table">
				<thead>
					<th>GroupID </th>
				</thead>
				<tbody>
					@foreach ($billresults as $billresult)
						<td><h2>{{ $billresult->GroupID }}</h2></td>
						<table class="table">
							<thead>
								<tr>
									<th>Billing Date</th>
									<th>Category</th>
									<th>Service(s)</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total Price</th>
									<th>Outstanding</th>
									<th>Amount Paid</th>
								</tr>
							</thead>
							<tbody>
								@foreach(App\Billing::details($billresult->GroupID) as $d)
								<tr>
									<td>{{ $d->BillingDate }}</td>
									<td>{{ $d->ServiceDesc }}</td>
									<td>{{ $d->Produt_ServiceType }}</td>
									<td>{{ $d->Price }}</td>
									<td>{{ $d->Quantity }}</td>
									<td>{{ $d->QuantityPrice }}</td>
									<td style="color:red">{{ $d->AmountOutstanding }}</td>
									<td style="color:green">{{ $d->AmountPaid }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</tbody>
					@endforeach
			</table> --}}
		</div>
	</div>

	</div>
</div>
@endsection

