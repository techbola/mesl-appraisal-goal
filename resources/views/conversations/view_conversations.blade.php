@extends('layouts.master')

@section('title')
	Conversations With {{ $contact->Customer }}
@endsection

{{-- @section('page-title')
	Call Conversations
@endsection --}}

@section('buttons')
	<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_conv">New Conversation</button>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Conversations With {{ $contact->Customer }}</div>

    <ul class="my-list">
      <li>
        <b>Title:</b> {{ $contact->title->Title ?? '&mdash;' }}
      </li>
      <li>
        <b>Name:</b> {{ $contact->Customer ?? '&mdash;' }}
      </li>
      <li><b>Phone:</b> {{ $contact->MobilePhone1 ?? '&mdash;' }}</li>
      <li><b>Estate:</b> {{ $contact->Estate ?? '&mdash;' }}</li>
      <li><b>House Type:</b> {{ $contact->housetype->HouseType ?? '&mdash;' }}</li>
    </ul>
  </div>

  <div class="card-box">
    <div class="card-title">
      Conversations
    </div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th>Conversation</th>
        <th>Date</th>
        <th>Site Visit?</th>
        <th>Visit Completed?</th>

      </thead>
    </table>
  </div>
@endsection
