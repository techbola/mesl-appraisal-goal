@extends('layouts.master')

@section('title')
	Edit Contact
@endsection

{{-- @section('page-title')
	Business Contacts
@endsection --}}

@section('content')
	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
			<div class="card-box">
				@include('errors.list')
		    <div class="card-title">Edit Contact</div>
				{{ Form::model($person, ['route' => ['update_contact', $person->CustomerRef ], 'role' => 'form']) }}
				{{ method_field('PATCH') }}
				@include('contacts.form')
				<button type="submit" class="btn btn-info">Submit</button>
				{{ Form::close() }}
		  </div>
	  </div>
	</div>


@endsection
