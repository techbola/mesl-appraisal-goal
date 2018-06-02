@extends('layouts.master')

@push('styles')
	<style>
	.panel:hover {
		transform: scale(1.05);
		cursor: pointer;
		transition: 0.2s ease-in;
	}


/*@media only screen and (min-width : 768px) {
    .table-row {
        display: table;
    }
    .table-row [class*="col-"] {
        /*float: none;*/
        display: table-cell;
        /*vertical-align: top;*/
    }
}*/
	</style>
@endpush

@section('content')

	<div id="accounts_spinner" style="display: none; padding-top:40vh" class="text-center">
		<img src="{{ asset('assets/img/spinner.gif') }}" alt="" width="40px">
	</div>


<div class="container-fluid container-fixed-lg">

	<div class="row">
		<form id="accounts_form" method="post" onsubmit="return false;">
			{{ csrf_field() }}
			<div class="col-md-5">
				<div class="form-group">
					<select id="acc_type" class="form-control select2" name="account_type" data-init-plugin="select2">
						<option value="0">All Account Types</option>
						@foreach ($account_types as $type)
							<option value="{{ $type->AccountTypeRef }}">{{ $type->AccountType }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<input type="text" id="bank" class="form-control" name="bank" placeholder="Enter bank name">
				</div>
			</div>

			<div class="col-md-2">
				<input type="submit" value="Filter" class="btn btn-success btn-cons">
			</div>
		</form>


	</div>

	<div id="accounts_row" class="row m-t-30 table-row">


		@foreach($accounts as $account)
			<?php
				if($account->CurrencyID == '1') {
					$currency = '&#8358;';
				}
				elseif($account->CurrencyID == '2'){
					$currency = '&dollar;';
				}elseif($account->CurrencyID == '3'){
					$currency = '&pound;';
				}elseif($account->CurrencyID == '4'){
					$currency = '&euro;';
				}
			?>
			<a href="{{ route('transactions.show', ['id'=>$account->GLRef]) }}" class="">
				<div class="col-md-4">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">
								{{ str_limit($account->Description, 27) }}
							</div>
						</div>
						<div class="panel-body">
							{{-- <h5 class="theme-primary">GTB</h5> --}}
							<div class=""><span class="theme-secondary f15">Acc No:</span> <span class="text-success f18 font-title">{{ $account->AccountNo }}</span></div>
							<div class="m-t-5"><span class="theme-secondary f15">Balance: </span><span class="text-success f18 font-title">{!! $currency !!} {{ number_format($account->ClearedBalance) }}</span></div>
						</div>
					</div>
				</div>
			</a>
		@endforeach

	</div>

	<div id="no_accounts" style="display: none" class="empty text-center m-b-20">
		No Accounts Found
	</div>


</div>
@endsection

@push('scripts')
	<script>
		$('#accounts_form').on('submit', function(){
			var form_data = $('#accounts_form').serialize();

			var bank = $('#bank').val();
			var acc_type = $('#acc_type').val();
			if (bank == '' || bank == null) {
				bank = 0;
			}
			console.log(bank);
			$('#accounts_spinner').show();
			setTimeout(function(){
				$.post('/get_accounts_local/'+ acc_type +'/'+ bank, form_data, function(data, status){
						$('#accounts_row').empty(); // empty contents first to avoid double results
						$.each(data, function(index, value){
	              // var base_url = $('#base_url').val();

								// Get currency symbol
								if(value.CurrencyID == '1') {
									var currency = '&#8358;';
								}
								else if(value.CurrencyID == '2'){
									var currency = '&dollar;';
								}else if(value.CurrencyID == '3'){
									var currency = '&pound;';
								}else if(value.CurrencyID == '4'){
									var currency = '&euro;';
								}

	              $('#accounts_row').append(`
									<a href="/transactions/${value.GLRef}" class="">
										<div class="col-md-4">
											<div class="panel panel-info">
												<div class="panel-heading">
													<div class="panel-title">
														${ value.Description.substr(0, 27) }
													</div>
												</div>
												<div class="panel-body">
													<div class=""><span class="theme-secondary f15">Acc No:</span> <span class="text-success f18 font-title"> ${ value.AccountNo } </span></div>
													<div class="m-t-5"><span class="theme-secondary f15">Balance: </span><span class="text-success f18 font-title">${ currency } ${ Number(value.ClearedBalance).toLocaleString() } </span></div>
												</div>
											</div>
										</div>
									</a>`
								);

							});

							if (data.length == 0) {
								$('#no_accounts').show();
							}
							else {
								$('#no_accounts').hide();
							}


					// );
					$('#accounts_spinner').hide();
				});
			}, 1000);
		});
	</script>
@endpush
