@extends('layouts.master')

@section('buttons')
  <a href="{{ route('create_call_memo', $contact->CustomerRef) }}" class="btn btn-sm btn-info btn-rounded">New Memo</a>
@endsection

@section('title')

@endsection

@section('content')
  <style media="screen">
    .thead {
      font-weight: bold;
      font-size: 13px !important;
    }
  </style>
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
      @if (count($contact->call_memos) == 0)
        <tbody>
          <tr class="m-t-20 m-b-20">
            <td colspan="5">
              No Call Memos Created Yet
            </td>
          </tr>
        </tbody>
      @endif
      @foreach ($contact->call_memos as $memo)

        <tbody>
          <tr>
            <td class="details-control" style="cursor:pointer"><i class="fa fa-plus-circle text-success f20" onclick="toggle_row('memo_{{ $memo->CallMemoRef }}')"></i></td>
            <td>{{ $memo->Attendees }}</td>
            <td>{{ $memo->Handouts }}</td>
            <td>{{ $memo->Location }}</td>
            <td>
              {{ $memo->MeetingDate }}
              <a class="m-l-15 add_point pointer btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#disc_point" onclick="get_memo_id('{{ $memo->CallMemoRef }}')"> <i class="fa fa-plus m-r-5"></i> Discussion Point</a>
            </td>
          </tr>
        </tbody>
        <tbody id="memo_{{ $memo->CallMemoRef }}" style="display:none">

          @php $disc_count = 0; @endphp
          @foreach ($memo->discussions as $discuss)

            @php $disc_count++; @endphp
            {{-- <tbody> --}}
            <tr>
              <td></td>
              <td class="small"><b>Discussion Point {{ $disc_count }}</b></td>
              <td colspan="2" class="small">{!! $discuss->DiscussionPoint !!}</td>
              <td>
                {{-- <a class="add_point f20 pointer" data-toggle="modal" data-target="#action_point" onclick="get_disc_id('{{ $discuss->id }}')"><i class="fa fa-plus-circle text-success" data-toggle="tooltip" title="Add Action Point"></i></a> --}}
                <div class="pull-right">
                  <a class="add_point pointer btn btn-xs btn-success" data-toggle="modal" data-target="#action_point" onclick="get_disc_id('{{ $discuss->id }}')"><i class="fa fa-plus m-r-5"></i> Action Point</a>
                  {{-- <i class="fa fa-level-up m-l-10 m-r-5"></i> --}}
                </div>
              </td>
            </tr>
          {{-- </tbody> --}}
          @if (count($discuss->actions) > 0)
            <tr>
              <td></td>
              <td></td>
              <td class="thead">Action Point</td>
              <td class="thead">Responsibility</td>
              <td class="thead">Timeline</td>
            </tr>
          @endif
            @foreach ($discuss->actions as $action)
              {{-- <tbody> --}}

              <tr>
                <td></td>
                <td></td>
                <td class="small"><i class="fa fa-bullseye text-muted m-r-5 f16"></i> {{ $action->ActionPoint }}</td>
                <td class="small"><i class="fa fa-user text-muted m-r-5 f15"></i> {{ $action->user->FullName }}</td>
                <td class="small"><i class="fa fa-clock-o text-muted m-r-5 f16"></i> {{ $action->StartDate.' - '.$action->EndDate  }}</td>
              </tr>
            @endforeach

          @endforeach
        </tbody>
        @endforeach
    </table>
  </div>


{{-- Add Action Point --}}
  <div class="modal fade" id="action_point" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Add New Action Point</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form class="" action="" method="post">
            {{ csrf_field() }}
            <div class="col-md-12">

              <div class="form-group">
                <label for="">Action Point</label>
                {{-- <input type="text" name="ActionPoint" class="form-control" placeholder="Enter action point"> --}}
                <textarea name="ActionPoint" rows="2" class="form-control" placeholder="Enter action point"></textarea>
              </div>
              <div class="form-group">
                <label>Responsibility</label>
                <select data-init-plugin="select2" class="full-width select2" name="UserID">
                  <option value="">Select Staff</option>
                  @foreach ($staffs as $staff)
                    <option value="{{ $staff->UserID }}">{{ $staff->FullName }}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('StartDate', 'Start Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('EndDate', 'End Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
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


  {{-- Add Discussion Point --}}

  <div class="modal fade" id="disc_point" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Add Discussion Point</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form class="" action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="">Discussion Point</label>
              {{-- <input type="text" name="ActionPoint" class="form-control" placeholder="Enter action point"> --}}
              <textarea name="DiscussionPoint" class="summernote"></textarea>
            </div>

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
