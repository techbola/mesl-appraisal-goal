@extends('layouts.master')

@section('buttons')
  <a href="{{ route('create_call_memo', $contact->CustomerRef) }}" class="btn btn-sm btn-info btn-rounded">New Meeting Note</a>
@endsection

@section('title')

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
    <div class="card-title">
      Meeting Notes with — <span class="text-muted small">{{ $contact->Customer }} {{ ($contact->Organization)? '('.$contact->Organization.')' : '' }}</span>
    </div>

    <table id="#call_memo" class="table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Attendees</th>
          <th>Handouts</th>
          <th>Location</th>
          <th>Meeting Date</th>
          <th width="20%"></th>
        </tr>
      </thead>
      @if (count($contact->call_memos) == 0)
        <tbody>
          <tr class="m-t-20 m-b-20">
            <td colspan="6">
              No Call Memos Created Yet
            </td>
          </tr>
        </tbody>
      @endif
      @foreach ($contact->call_memos as $memo)

@if (in_array($user->email, explode(',', $memo->AttendeeEmails)) || $user->hasRole('admin'))

        <tbody>
          <tr id="parent_{{ $memo->CallMemoRef }}">
            <td class="details-control" style="cursor:pointer"><i class="fa fa-plus-circle text-success f20" onclick="toggle_row('{{ $memo->CallMemoRef }}')"></i></td>
            <td>{{ $memo->Attendees }}</td>
            <td>{{ $memo->Handouts }}</td>
            <td>{{ $memo->Location }}</td>
            <td>
              {{ $memo->MeetingDate }}
            </td>
            <td class="actions">
              <span class="pull-right">
                <a href="#" onclick="confirm2('Send memo to attendees?', '', 'email_attendees_{{ $memo->CallMemoRef }}')" class="btn btn-inverse btn-xs"><i class="fa fa-envelope m-r-5"></i> Send</a>
                <form id="email_attendees_{{ $memo->CallMemoRef }}" class="hidden" action="{{ route('email_attendees', $memo->CallMemoRef) }}" method="post">
                  {{ csrf_field() }}
                </form>
                <a class="m-l-10 add_point pointer btn btn-xs btn-info" data-toggle="modal" data-target="#disc_point" onclick="get_memo_id('{{ $memo->CallMemoRef }}')"> <i class="fa fa-plus m-r-5"></i> Discussion</a>
                <a class="m-l-5 pointer btn btn-xs btn-warning" data-toggle="modal" data-target="#edit_memo" @click="edit_memo({{ $memo }})">Edit</a>

                <a href="{{-- route('download_meeting_report', ) --}}">Download</a>

                {{-- <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ... <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="">Account Statement</a></li>
                      <li><a href="">Interest Accruals</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="">Edit Account</a></li>
                    </ul>
                  </div> --}}

              </span>
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
              <td colspan="3" class="small">{!! $discuss->DiscussionPoint !!}</td>
              <td>
                {{-- <a class="add_point f20 pointer" data-toggle="modal" data-target="#action_point" onclick="get_disc_id('{{ $discuss->id }}')"><i class="fa fa-plus-circle text-success" data-toggle="tooltip" title="Add Action Point"></i></a> --}}
                <div class="pull-right">
                  {{-- <a class="add_point pointer btn btn-xs btn-success" data-toggle="modal" data-target="#action_point" onclick="get_disc_id('{{ $discuss->id }}')"><i class="fa fa-plus m-r-5"></i> Action Point</a> --}}


                  <div class="dropdown">
                    <a type="button" class=" btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" {{--id="disc_dropdown_{{ 'test' }}" --}}>
                      {{-- <i class="fa fa-ellipsis-h"></i> --}} Actions <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a class="pointer" data-toggle="modal" data-target="#action_point" onclick="get_disc_id('{{ $discuss->id }}')">Add Action Point</a></li>
                      <li><a class="pointer" data-toggle="modal" data-target="#edit_disc" @click="edit_discussion('{{ $discuss->id }}')">Edit Discussion</a></li>
                      {{-- <li role="separator" class="divider"></li>
                      <li><a class="pointer">Delete</a></li> --}}
                    </ul>
                  </div>

                </div>
              </td>
            </tr>
          {{-- </tbody> --}}

          @if (count($discuss->actions) > 0)
            <tr class="action_row">
              <td></td>
              <td></td>
              <td class="thead">Action Point</td>
              <td class="thead">Responsibility</td>
              <td class="thead">Comment</td>
              <td class="thead">Timeline</td>
              {{-- <td class="thead">Status</td> --}}
            </tr>
          @endif
            @foreach ($discuss->actions as $action)
              {{-- <tbody> --}}

              <tr class="action_row">
                <td></td>
                <td><span class="label label-{{ $action->status->Color }} pull-right">{{ $action->status->Status }}</span></td>
                <td class="small"><i class="fa fa-bullseye text-muted m-r-5 f16"></i> {!! $action->ActionPoint !!}</td>
                <td class="small"><i class="fa fa-user text-muted m-r-5 f15"></i> {{ $action->user->FullName }}</td>
                <td class="small"><i class="pg-comment text-muted m-r-5 f15"></i> {!! $action->Comment ?? '—' !!}</td>
                <td class="small">
                  <i class="fa fa-clock-o text-muted m-r-5 f16"></i> {{ $action->StartDate.' - '.$action->EndDate  }}
                  <br>
                  <div class="dropdown">
                    <a type="button" class=" btn btn-default btn-xs pull-right dropdown-toggle" data-toggle="dropdown">
                      Actions <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a class="pointer" data-toggle="modal" data-target="#edit_action" @click="edit_action('{{ $action->id }}')">Edit Action Point</a></li>
                      @if ($user->id == $action->user->id)
                        <li><a href="{{ route('edit_action_point', $action->id) }}" class="pointer">Review Action</a></li>
                      @endif
                      {{-- <li role="separator" class="divider"></li>
                      <li><a class="pointer">Delete</a></li> --}}
                    </ul>
                  </div>

                </td>


              </tr>
            @endforeach

          @endforeach
        </tbody>

@endif
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
            </div>
            <div class="col-md-6">
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
                <label>Status</label>
                <select data-init-plugin="select2" class="full-width select2" name="StatusID">
                  @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->Status }}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('StartDate', 'Start Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('EndDate', 'End Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
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

{{-- Edit Action Point --}}
  <div class="modal fade" id="edit_action" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Edit Action Point</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form class="" action="" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-md-12">

              <div class="form-group">
                <label for="">Action Point</label>
                {{-- <input type="text" name="ActionPoint" class="form-control" placeholder="Enter action point"> --}}
                <textarea name="ActionPoint" rows="2" class="form-control" placeholder="Enter action point"></textarea>
              </div>
            </div>
            <div class="col-md-6">
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
                <label>Status</label>
                <select data-init-plugin="select2" class="full-width select2" name="StatusID">
                  @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->Status }}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('StartDate', 'Start Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'v-model' => 'action.StartDate']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('EndDate', 'End Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'v-model' => 'action.EndDate']) }}
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

  {{-- Edit Discussion Point --}}
  <div class="modal fade" id="edit_disc" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Edit Discussion Point</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form id="edit_disc_form" class="" action="" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
              <label for="">Discussion Point</label>
              {{-- <input type="text" name="ActionPoint" class="form-control" placeholder="Enter action point"> --}}
              <textarea name="DiscussionPoint" class="summernote" v-model="discussion.DiscussionPoint">@{{ discussion.DiscussionPoint }}</textarea>
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

  {{-- Edit Memo --}}
  <div class="modal fade" id="edit_memo" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Edit Meeting Note</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <form class="" action="" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Attendees</label>
                  <input type="text" class="form-control" name="Attendees" placeholder="Attendees" required v-model="memo.Attendees">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Handouts</label>
                  <input type="text" class="form-control" name="Handouts" placeholder="Handouts" v-model="memo.Handouts">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Location</label>
                  <input type="text" class="form-control" name="Location" placeholder="Location" required v-model="memo.Location">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Meeting Type</label>
                  <select class="form-control select2" name="MeetingTypeID" data-init-plugin="select2" placeholder="Select meeting type" v-model="memo.MeetingTypeID">
                    <option value=""></option>
                    @foreach ($meeting_types as $type)
                      <option value="{{ $type->MeetingTypeRef }}">{{ $type->MeetingType }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Meeting Date</label>
                  <div class="input-group date dp">
                    <input type="text" class="form-control" name="MeetingDate" placeholder="MeetingDate" v-model="memo.MeetingDate" required>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">

                <div class="form-group required">
                  <label>Attendees Emails</label>
                  <span class="help">Type an email, then press enter.</span>
                  <input name="AttendeeEmails" class="tagsinput custom-tag-input" type="text" placeholder="Enter emails of attendees."/>
                </div>

              </div>
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

@push('vue')
  <script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" charset="utf-8"></script>
  <script>

		new Vue({
			el: '#app',
			data: {
				memo: {},
        discussion: {},
        action: {},
			},
			methods: {
				edit_memo(memo) {
					this.memo = memo;
          var form_action = "{{ url('/') }}"+"/call-memo/update/"+this.memo.CallMemoRef;
          $('#edit_memo').find('form').attr('action', form_action);
          $('.custom-tag-input').tagsinput('removeAll');
          $('.custom-tag-input').tagsinput('add', this.memo.AttendeeEmails);
          $('#edit_memo select[name="MeetingTypeID"]').val(this.memo.MeetingTypeID).trigger('change');
				},
				edit_discussion(id) {
          $.get('/fetch_discussion/'+id, function(data, status){
            this.discussion = data;
            var form_action = "{{ url('/') }}"+"/call-memo/update_discussion/"+data.id;
            $('#edit_disc').find('form').attr('action', form_action);
            $('#edit_disc_form').find('.note-editable').html(data.DiscussionPoint);
          });
				},
				edit_action(id) {
          $.get('/fetch_action/'+id, function(data, status) {
            this.action = data;
            var form_action = "{{ url('/') }}"+"/call-memo/update_action/"+data.id;
            $('#edit_action').find('form').attr('action', form_action);
            $('#edit_action textarea[name="ActionPoint"]').text(data.ActionPoint);
            $('#edit_action select[name="UserID"]').val(data.UserID).trigger('change');
            $('#edit_action select[name="StatusID"]').val(data.StatusID).trigger('change');
            $('#edit_action input[name="StartDate"]').val(data.StartDate).trigger('keyup');
            $('#edit_action input[name="EndDate"]').val(data.EndDate).trigger('keyup');
          });
				},
			},
		});
	</script>
@endpush

@push('scripts')
  <script>
  // $(document).ready(function()
    var table = $('#call_memo');

    // Add event listener for opening and closing details
    $('#call_memo tbody').on('click', 'td.details-control', function () {
      // console.log('click');
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
      $('#memo_'+id).toggle();
      $('#parent_'+id+' td.details-control i').toggleClass('fa fa-plus-circle text-success').toggleClass('fa fa-minus-circle text-danger');
    }
  </script>


  <script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $('.custom-tag-input').tagsinput({
      confirmKeys: [13, 188],
      trimValue: true
    });

    $('.bootstrap-tagsinput input').blur(function() {
      $('.custom-tag-input').tagsinput('add', $(this).val());
      $(this).val('');
    });
  </script>
@endpush
