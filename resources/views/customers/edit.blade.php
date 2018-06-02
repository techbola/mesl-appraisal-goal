@extends('layouts.master')

@section('content')
<div class="card-box">
		<div class="card-title">
			Edit Customer
		</div>
		{{ Form::model($customer, ['action' => ['CustomerController@update', $customer->CustomerRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('customers.form', ['buttonText' => 'Update Customer'])
		{{ Form::close() }}
</div>
@endsection
