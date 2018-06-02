@extends('layouts.master')

@section('content')
@if(count($companies) === 1)
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default bg-success">
        <div class="panel-heading separator">
            <div class="panel-title">
                Company created already !!!
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                	<img src="{{ url('images/CompanyLogo', $companies->LogoUrl ) }}" alt="" style="width: 300px; height: 81px; margin-top: 10px;">
                </div>
                <div class="col-md-6">
                	<h3>{{ $companies->Company }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="panel panel-default" style="top : 30px; margin-bottom: 60px">
    <div class="panel-heading">
        <div class="panel-title">
            Create Company
        </div>
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => 'CompanyController@store', 'files' => true, 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('companies.form', ['buttonText' => 'Create Company'])
		{{ Form::close() }}
    </div>
</div>
@endif
@endsection
