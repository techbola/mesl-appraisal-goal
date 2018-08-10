@extends('layouts.master')

@push('styles')

<style>
	tfoot{
      display: table-header-group;
     }
     input[placeholder=Currency] {
	    width: 100% !important;
	}
</style>
@endpush

@section('content')
	<div class="card-box">
		<div class="card-title">
			Search for Account Statement
		</div>
		
		<div class="row">
			
			<div class="col-md-6 col-md-offset-3">
				 {{ Form::open(['action' => 'TransactionController@show_searched_result', 'autocomplete' => 'off', 'role' => 'form']) }}
				 
				  <div class="col-sm-12">
                   <div class="form-group">
                           {{ Form::label('Account Type', 'Select Account Type') }}
                           <select name="AccountType" class="form-control select2"    data-init-plugin="select2" required>
                               <option value="">Account Type</option>
                               @foreach($accounts as $account)
                                   <option value="{{ $account->AccountTypeRef }}">{{ $account->AccountType }}</option>
                               @endforeach
                           </select>
                   
               </div>
           </div>
           <div class="pull-right">
           	  <input type="submit" class="btn btn-info btn-sm pull-right" value="Search for statement">
           </div>
               {{ Form::close() }}
			</div>
		</div>
</div>
@endsection

