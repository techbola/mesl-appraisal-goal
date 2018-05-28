@extends('layouts.master')

@section('buttons')
  <a href="{{ route('create_call_memo', $contact->CustomerRef) }}" class="btn btn-sm btn-info btn-rounded">New Memo</a>
@endsection

@section('title')

@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">
      Call Memo - {{ $contact->Customer }} {{ ($contact->Organization)? '- '.$contact->Organization : '' }}
    </div>

    <table id="#call_memo" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Attendees</th>
          <th>Handouts</th>
          <th>Location</th>
          <th>Meeting Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contact->call_memos as $memo)
          <tr>
            <td class="details-control" style="cursor:pointer"><i class="fa fa-plus"></i></td>
            <td>{{ $memo->Attendees }}</td>
            <td>{{ $memo->Handouts }}</td>
            <td>{{ $memo->Location }}</td>
            <td>{{ $memo->MeetingDate }}</td>
          </tr>
          @foreach ($memo->discussions as $discuss)
            <tr>
              <td></td>
              <td class="small"><b>Discussion Point</b></td>
              <td colspan="2" class="small">{{ $discuss->DiscussionPoint }}</td>
              <td>
                <a class="f20 pointer" data-toggle="modal" data-target="#action_point"><i class="fa fa-plus-circle text-success" data-toggle="tooltip" title="Add Action Point"></i></a>
              </td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  </div>


  <div class="modal fade" id="action_point" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Add New Action Point</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form class="" action="index.html" method="post">

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
  // $(document).ready(function()
    var table = $('#call_memo');

    // Add event listener for opening and closing details
    $('#call_memo tbody').on('click', 'td.details-control', function () {
      console.log('click');
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            // row.child( format(row.data()) ).show();
            row.child.show();
            tr.addClass('shown');
        }
    } );
  </script>
@endpush
