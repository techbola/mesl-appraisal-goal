@extends('layouts.master')

@section('title')
	Conversations With {{ $contact->Customer }}
@endsection

{{-- @section('page-title')
	Call Conversations
@endsection --}}

@section('buttons')
	<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#new_conv">New Conversation</button>
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
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($contact->conversations as $conv)
          <tr>
            <td>{{ $conv->Conversation }}</td>
            <td>{{ ($conv->Date)? Carbon::parse($conv->Date)->format('jS M, Y') : '&mdash;' }}</td>
            <td>{{ ($conv->SiteVisit)? 'Yes':'No' }}</td>
            <td>{{ ($conv->VisitCompleted)? 'Yes':'No' }}</td>
            <td class="actions">
              <a href="#" class="btn btn-xs btn-inverse">Edit</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="new_conv">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Add New Conversation</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          {!! Form::open(['route' => ['store_conversation', $contact->CustomerRef], 'role' => 'form']) !!}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {!! Form::label('Conversation') !!}
                {!! Form::textarea('Conversation', null, ['class'=>'form-control', 'placeholder'=>'Conversation', 'rows'=>'5']) !!}
              </div>
            </div>

            <div class="col-md-5">
              {{ Form::label('Date', 'Date', ['class'=>'form-label']) }}
              <div class="input-group date dp">
                {{ Form::text('Date', null, ['class' => 'form-control', 'placeholder' => 'Date']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
            <div class="col-md-3">
              <label for=""></label>
              <div class="checkbox check-success">
                <input type="checkbox" name="SiteVisit" id="SiteVisit">
                <label for="SiteVisit">Site Visit</label>
              </div>
            </div>
            <div class="col-md-4">
              <label for=""></label>
              <div class="checkbox check-success">
                <input type="checkbox" name="VisitCompleted" id="VisitCompleted">
                <label for="VisitCompleted">Visit Completed</label>
              </div>
            </div>
          </div>
          <div class="text-right m-t-10">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
