@extends('layouts.master')
@section('title')
  Memorandum
@endsection

@section('page-title')
  Internal Memo
@endsection
 
@section('buttons')
  <a href="{{ route('memos.create') }}" class="btn btn-info btn-rounded pull-right" >New Memo</a>
  {{-- <a href="{{ route('memos_approvallist') }}" class="btn btn-info btn-rounded m-r-5 pull-right" >Approvals <span class="badge m-l-5">{{ $unapproved_memos->count() }}</span></a> --}}
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.5.1/css/scroller.dataTables.min.css">
@endpush

@section('content')

  	<!-- START PANEL -->
    <div class="card-title pull-left">All Memos</div>
    <div class="pull-right">
      <div class="col-xs-12">
        <input type="text" class="search-table form-control pull-right" placeholder="Search">
      </div>
    </div>
    <div class="clearfix"></div>
  	<div class="">

      <div class="tab-content">
        <div id="unapproved" class=" in">
          
            <div class="card-box ">
                <table class="table tableWithSearch">
                  <thead>
                    <th>Actions</th>
                    <th>Initiator</th>
                    <th width="">Subject</th>
                    <th width="">Purpose</th>
                    <th width="">Date</th>
                    

                  </thead>
                  <tbody>
                    @foreach ( $memos as $memo)
                      <tr>
                        <td class="actions" width="100">
                          @if(!$memo->sent())
                          <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" @if($memo->processed_flag) disabled @endif data-memo-id="{{ $memo->id }}" class="btn btn-info btn-sm @if($memo->processed_flag) disabled @endif" id="routing-button">Re-Route </a>
                          @else
                          <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" @if($memo->processed_flag) disabled @endif  data-memo-id="{{ $memo->id }}" class="btn btn-info btn-sm @if($memo->processed_flag) disabled @endif" id="routing-button">Re-Route </a>
                          @endif
                        </td>
                        <td>{{ $memo->initiator->FullName ?? '-' }}</td>
                        <td>{{ $memo->subject }}</td>
                        <td>{{ $memo->purpose }}</td>
                        <td>{{ $memo->created_at->toDateTimeString() }}</td>
                        
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
      </div>
  			

  	</div>
  	<!-- END PANEL -->


    <!-- Modal -->
  <div class="modal fade slide-up" id="show-route-form" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold pull-left">Re-route Memo Approver</h4>
            <div class="clearfix"></div>
          </div> <hr>
          <div class="modal-body memo-body">
            <form action="/memos/routing" method="post" >
                {{ csrf_field() }}
                <input type="hidden" id="memo_id" name="id" value="">
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('ApproverID1', 'Approver 1') }}
                            {{ Form::select('ApproverID1', [0 => 'Select Approver'] + $staff->pluck('FullName','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('ApproverID2', 'Approver 2') }}
                            {{ Form::select('ApproverID2', [0 => 'Select Approver'] + $staff->pluck('FullName','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('ApproverID3', 'Approver 3') }}
                            {{ Form::select('ApproverID3', [0 => 'Select Approver'] + $staff->pluck('FullName','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('ApproverID4', 'Approver 4') }}
                            {{ Form::select('ApproverID4', [0 => 'Select Approver'] + $staff->pluck('FullName','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                        </div>
                    </div>
                </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="submit" class="btn btn-info hide-on-print">Submit</button>
            <button type="button" class="btn btn-default hide-on-print" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->



@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script>
  <script src="{{ asset('js/printThis.js') }}"></script>
  <script src="{{ asset('js/jquery-printme.min.js') }}"></script>
  <script>
    $(function(){
      $('.table').on('click', '.preview_memo', function(e) {
        e.preventDefault();
        var url = $(this).prop('href');
        var memo_path = '{{ asset('storage/memo_attachments') }}/';
          $("#show-memo").find('.memo-subject').html(' ');
          $("#show-memo").find('.memo-purpose').html(' ');
          $("#show-memo").find('.memo-status').html(' ');
          $("#show-memo").find('.memo-status').removeClass('badge-success')
          $("#show-memo").find('.memo-approvers').html(' ');
          $("#show-memo").find('.memo-recipients').html(' ');
          $("#show-memo").find('.memo-body').html(' ');
           $('#show-memo .modal-footer .files').html(' ');
          $("#show-memo").find('.memo-approved').html(' ');
        $.get(url, function(data) {
          // activate modal
          $("#show-memo").find('.memo-subject').html(data.subject);
          $("#show-memo").find('.memo-purpose').html(data.purpose);
          // $("#show-memo").find('.memo-status').html(data.status);
          $("#show-memo").find('.memo-approvers').html(data.approvers);
          $("#show-memo").find('.memo-body').html(data.body);
          $("#show-memo").find('.memo-recipients').html(data.recipient_list.join(', '));
           if(data.approved === true){
              $("#show-memo").find('.memo-status').html('approved').addClass('approved');
              $("#show-memo").find('.memo-status').addClass('badge-success');
              $("#show-memo").find('.memo-approved').html('<img src="{{ asset('images/checkmark.svg') }}" width="30">');
            } else {
              $("#show-memo").find('.memo-status').html(data.status);
            }
          $("#show-memo").modal('show');
          // list attachements
          if(data.attachments.length > 0 ){
            $.each(data.attachments, function(index, val) {
               $('#show-memo .modal-footer .files').html(`
                <a target="_blank" href="/download-memo-attachments/${data.id}">Download Attachment(s)</a>&nbsp;
              `);
            });
          }
        });
      });
    });

    function print_memo() {
        return $("#show-memo").printMe({
          "path": ["{{ asset('css/printmemo.css') }}"]
        }); 
    }

    function activate_memo_inbox_queue(){
        let url = new URL(window.location.href);
        let queue = url.searchParams.get('tab'); 
        if(queue != null && queue == 3) {
            $('a[href="#inbox"]').tab('show');
        }
    }

    activate_memo_inbox_queue();

    // datatbles
    var data = [];
        for ( var i=0 ; i<50000 ; i++ ) {
            data.push( [ ] );
        }
         
        // $('#example').DataTable( {
        //     data:           ,
        //     deferRender:    true,
        //     scrollY:        200,
        //     scrollCollapse: true,
        //     scroller:       true
        // } );
    
        //  re-roting logic
        $('table').on('click', '#routing-button', function(e) {
          e.preventDefault();
          let memo_id = $(this).data('memoId');
          $.post('/memos/fetch-memo-approvers', {id: memo_id, _token: $('[name="csrf-token"]').attr('content')}, function(data, textStatus, xhr) {
            console.log(data.data.ApproverID1);
            $('#memo_id').val(data.data.id);
            $('#ApproverID1').val(data.data.ApproverID1).trigger('change');
            $('#ApproverID2').val(data.data.ApproverID2).trigger('change');
            $('#ApproverID3').val(data.data.ApproverID3).trigger('change');
            $('#ApproverID4').val(data.data.ApproverID4).trigger('change');
          });
          $('#show-route-form').modal('show');

          /* Act on the event */
        });
  </script>
@endpush



