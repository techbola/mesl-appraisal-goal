@extends('layouts.master')

@section('title')
  Review Call Memo Actions
@endsection

@section('buttons')
  <a href="{{ route('business_contacts') }}" class="btn btn-info btn-rounded">Contacts</a>
@endsection

@push('styles')
  <style>
    .thead {
      font-weight: bold;
      font-size: 13px !important;
    }
    table.table tbody tr.disc_row td {
      background: #fff6e2 !important;
    }
    table.table tbody tr.action_row td {
      background: #f2ffe8 !important;
    }
  </style>
@endpush

@section('content')
  <div class="card-box">
    <div class="card-title">Review Call Memo Actions Assigned To You</div>
    <table id="#call_memo" class="table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Attendees</th>
          <th>Handouts</th>
          <th>Location</th>
          <th>Meeting Date</th>
        </tr>
      </thead>
      @if (count($call_memos) == 0)
        <tbody>
          <tr class="m-t-20 m-b-20">
            <td colspan="5">
              No Actions Have Been Assigned To You
            </td>
          </tr>
        </tbody>
      @endif
      @foreach ($call_memos as $memo)

        <tbody>
          <tr>
            <td class="details-control" style="cursor:pointer"><i class="fa fa-plus-circle text-success f20" onclick="toggle_row('memo_{{ $memo->CallMemoRef }}')"></i></td>
            <td>{{ $memo->Attendees }}</td>
            <td>{{ $memo->Handouts }}</td>
            <td>{{ $memo->Location }}</td>
            <td>
              {{ $memo->MeetingDate }}
            </td>
          </tr>
        </tbody>
        <tbody id="memo_{{ $memo->CallMemoRef }}" style="display:none">

          @php $disc_count = 0; @endphp
          @foreach ($memo->discussions as $discuss)

            @php $disc_count++; @endphp
            {{-- <tbody> --}}
            <tr class="disc_row">
              <td></td>
              <td class="small"><b>Discussion Point {{ $disc_count }}</b></td>
              <td colspan="2" class="small">{!! $discuss->DiscussionPoint !!}</td>
              <td>

              </td>
            </tr>
          {{-- </tbody> --}}
          @if (count($discuss->actions->where('UserID', $user->id)) > 0)
            <tr class="action_row">
              <td></td>
              <td></td>
              <td class="thead">Action Point</td>
              <td class="thead">Comment</td>
              <td class="thead">Timeline</td>
              {{-- <td class="thead">Status</td> --}}
            </tr>
          @endif
            @foreach ($discuss->actions->where('UserID', $user->id) as $action)
              {{-- <tbody> --}}

              <tr class="action_row">
                <td></td>
                <td><span class="label label-{{ $action->status->Color }} pull-right">{{ $action->status->Status }}</span></td>
                <td class="small"><i class="fa fa-bullseye text-muted m-r-5 f16"></i> {{ $action->ActionPoint }}</td>
                <td class="small"><i class="pg-comment text-muted m-r-5 f15"></i> {{ $action->Comment ?? '&mdash;' }}</td>
                <td class="small">
                  <i class="fa fa-clock-o text-muted m-r-5 f16"></i> {{ $action->StartDate.' - '.$action->EndDate  }}
                  {{-- <a class="add_point pointer btn btn-xs btn-warning pull-right" data-toggle="modal" data-target="#action_point" onclick="edit_action('{{ $action->id }}')"><i class="fa fa-pencil m-r-5"></i> Review</a> --}}
                  <a href="{{ route('edit_action_point', $action->id) }}" class="add_point pointer btn btn-xs btn-warning pull-right">Review</a>
                </td>
                {{-- <td class="small"><span class="label label-info">status</span></td> --}}
              </tr>
            @endforeach

          @endforeach
        </tbody>
        @endforeach
    </table>
  </div>



  {{-- Edit Action Point --}}
    <div class="modal fade" id="action_point" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h5 class="card-title">Review Action Point</h5>
          </div>
          <div class="modal-body">
            @include('errors.list')
            <form class="" action="" method="post">
              {{ csrf_field() }}
              <div class="col-md-12">

                <div class="form-group">
                  <label for="">Action Point</label>
                  {{-- <input type="text" name="ActionPoint" class="form-control" placeholder="Enter action point"> --}}
                  <div id="action_text"></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Comment</label>
                  <textarea name="Comment" rows="2" class="form-control" placeholder="Enter comments."></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status</label>
                  <select data-init-plugin="select2" class="full-width select2" name="StatusID">
                    @foreach ($statuses as $status)
                      <option value="{{ $status->id }}">{{ $status->Status }}</option>
                    @endforeach
                  </select>
                </div>

              </div>


              <div class="clearfix"></div>

              <div class="text-right m-t-20">
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

    function edit_action(id){
      var form_action = "{{ url('/') }}"+"/call-memo/update_action_point/"+id;
      $('#action_point').find('form').attr('action', form_action);
    };

    function get_disc_id(id){
      var form_action = "{{ url('/') }}"+"/call-memo/store_action_point/"+id;
      $('#action_point').find('form').attr('action', form_action);
    };

    function get_memo_id(id){
      var form_action = "{{ url('/') }}"+"/call-memo/store_discussion_point/"+id;
      $('#disc_point').find('form').attr('action', form_action);
    };

    function toggle_row(id) {
      $('#'+id).toggle();
    }
  </script>
@endpush
