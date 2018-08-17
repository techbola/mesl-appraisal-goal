@extends('layouts.master')

@section('title')
	Call Conversations
@endsection

{{-- @section('page-title')
	Call Conversations
@endsection --}}

@section('buttons')
  <a href="{{ route('business_contacts') }}" class="btn btn-info btn-sm m-r-5">Back to Contacts List</a>
		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#new_contact">New Conversation</button>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Call Contacts</div>
    <table class="table table-bordered">
      <thead>
        <th>Title</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Estate</th>
        <th>House Type</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($contacts as $contact)
          <tr>
            <td>{{ $contact->title->Title ?? '—' }}</td>
            <td>{{ $contact->Customer ?? '—' }}</td>
            <td>{{ $contact->MobilePhone1 ?? '—' }}</td>
            <td>{{ $contact->Estate ?? '—' }}</td>
            <td>{{ $contact->housetype->HouseType ?? '—' }}</td>
            <td>
              <a href="{{ route('view_conversations', $contact->CustomerRef) }}" class="btn btn-sm btn-info">View Conversations</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>



  <div class="modal fade" id="new_contact">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Add New Conversation</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          {!! Form::open(['route' => 'store_call_contact', 'role' => 'form']) !!}
          @include('conversations.form')
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

@push('scripts')
  <script>
    $('.summernote').summernote({
      // height: '100px',
      placeholder: '',
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['fontname']],
        // ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        // ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
        ['misc', ['undo', 'redo']],
      ],
      dialogsInBody: true,
    });
  </script>
  <script>
    function select_contact() {
      // $('#contact-box').empty();
      $('#contact-box').html(`
        <div class="pull-right pointer">
          <a onclick="new_contact()" class="bold text-success">+ Add New Contact</a>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            {!! Form::label('Customer', 'Contact') !!}
            {!! Form::select('Customer', [''=>'Select Contact']+$contacts_all->pluck('Customer', 'CustomerRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
          </div>
        </div>
      `);
      $('select[class=full-width]').select2();
    }

    function new_contact() {
      $('#contact-box').html(`
        <div class="text-right pointer">
          <a onclick="select_contact()" class="bold text-success">+ Select Contact From List</a>
        </div>
        <div class="col-md-6">
          <div class="">
            {!! Form::label('TitleID', 'Title', ['class'=>'form-label']) !!}
            {!! Form::select('Title', [''=>'Select Title']+$titles->pluck('Title', 'TitleRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('Customer', 'Name') !!}
            {!! Form::text('Customer', null, ['class'=>'form-control', 'placeholder'=>'Enter Full Name']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('MobilePhone1', 'Mobile Phone') !!}
            {!! Form::text('MobilePhone1', null, ['class'=>'form-control', 'placeholder'=>'Mobile Phone 1']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('Estate', 'Estate Interested In') !!}
            {!! Form::text('Estate', null, ['class'=>'form-control', 'placeholder'=>'Estate Of Interest']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="">
            {!! Form::label('HouseTypeID', 'House Type', ['class'=>'form-label']) !!}
            {!! Form::select('HouseTypeID', [''=>'Select House Type']+$housetypes->pluck('HouseType', 'HouseTypeRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
          </div>
        </div>
      `);
      $('select[class=full-width]').select2();
    }
  </script>
@endpush
