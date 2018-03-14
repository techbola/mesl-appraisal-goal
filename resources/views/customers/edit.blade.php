@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Edit Product
		</div>
	</div>
	<div class="panel-body">
		{{ Form::model($customer, ['action' => ['CustomerController@update', $customer->CustomerRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('customers.form', ['buttonText' => 'Update Customer'])
		{{ Form::close() }}
	</div>
</div>
@endsection

