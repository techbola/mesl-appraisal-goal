@extends('layouts.master')
@section('title')
  Search for Client(s)
@endsection

@section('page-title')
  Search for Client(s)
@endsection

@section('buttons')
  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Add New Client</a> &nbsp &nbsp
  <a href="{{ route('LeaveRequest') }}" class="btn btn-success btn-rounded pull-right" >Add New Product or Service</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Search for Client(s)</div><div class="clearfix"></div>
        <div class="row">
          {{ Form::open(['action' => 'BillingController@client_search', 'autocomplete' => 'off', 'role' => 'form']) }}
          <div class="col-md-6 col-md-offset-3">
                 <div class="form-group">
                   {{ Form::label('client_name', 'Client Name' ) }}
                     {{ Form::text('client_name', null, ['class' => 'form-control', 'placeholder' => 'Client Name...', 'required']) }}
                   </div>

                   <div class="pull-right">
                     {{ Form::submit('Search', ['class' => 'btn btn-sm btn-info']) }}
                   </div>
          </div>
          {{ Form::close() }}
        </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
@endpush


