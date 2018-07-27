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
      <li><b>Estate:</b> {{ $contact->estate->ProjectName ?? '&mdash;' }}</li>
      <li><b>House Type:</b> {{ $contact->housetype->HouseType ?? '&mdash;' }}</li>
    </ul>
    <a class="btn btn-sm btn-inverse" data-toggle="modal" data-target="#edit_contact">Edit</a>
  </div>

  <div class="card-box">
    <div class="card-title">
      Conversations
    </div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th>Conversation</th>
        <th>Visit Date</th>
        <th>Assigned To</th>
        <th>Site Visit?</th>
        <th>Visit Completed?</th>
        <th>Logged By</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($contact->conversations as $conv)
          <tr>
            <td>{{ $conv->Conversation }}</td>
            <td>{{ ($conv->VisitDate)? Carbon::parse($conv->VisitDate)->format('jS M, Y') : '&mdash;' }}</td>
            <td>{{ $conv->assignedto->FullName ?? '&mdash;' }}</td>
            <td>{{ ($conv->SiteVisit)? 'Yes':'No' }}</td>
            <td>{{ ($conv->VisitCompleted)? 'Yes':'No' }}</td>
            <td>{{ ($conv->inputter->FullName ?? '&mdash;') }}</td>
            <td class="actions">
              <a class="btn btn-xs btn-inverse" data-toggle="modal" data-target="#edit_conv" onclick="edit_conv({{ $conv->ConversationRef }})">Edit</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>

  @include('conversations.modals')

@endsection

@push('scripts')
  <script>
    function edit_conv(id) {
      $.get('/get_conversation/'+id, function(data, status){
        console.log(data);
        $('#edit_conv').find('form').attr('action', '/update_conversation/'+id);
        $('#edit_conv').find('form textarea[name=Conversation]').text(data.Conversation);
        $('#edit_conv').find('form select[name=AssignedStaff]').val(data.AssignedStaff).trigger('change');
        $('#edit_conv').find('form input[name=VisitDate]').val(data.VisitDate).datepicker({format: 'yyyy-mm-dd'});
        if(data.SiteVisit == 1){
          $('#edit_conv').find('form input[name=SiteVisit]').attr('checked', true);
        }else{
          $('#edit_conv').find('form input[name=SiteVisit]').attr('checked', false);
        }
        if(data.VisitCompleted == 1){
          $('#edit_conv').find('form input[name=VisitCompleted]').attr('checked', true);
        } else {
          $('#edit_conv').find('form input[name=VisitCompleted]').attr('checked', false);
        }
      });
    }
  </script>
@endpush
