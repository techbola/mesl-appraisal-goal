@extends('layouts.master')

@section('title')
	Edit Contact
@endsection

{{-- @section('page-title')
	Business Contacts
@endsection --}}

@section('content')
  <div class="card-box">
    <div class="card-title">Edit Contact</div>
		{{ Form::model($contact, ['route' => ['update_contact', $contact->CustomerRef ], 'role' => 'form']) }}
		{{ method_field('PATCH') }}
		@include('contacts.form')
		<button type="submit" class="btn btn-info">Submit</button>
		{{ Form::close() }}
  </div>

@endsection
