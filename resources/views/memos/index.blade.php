@extends('layouts.master')
@section('title')
  Memorandum
@endsection

@section('page-title')
  Internal Memo
@endsection
 
@section('buttons')
  <a href="{{ route('memos.create') }}" class="btn btn-info btn-rounded pull-right" >New Memo</a>
  <a href="{{ route('memos_approvallist') }}" class="btn btn-info btn-rounded m-r-5 pull-right" >Approvals <span class="badge m-l-5">{{ $unapproved_memos->count() }}</span></a>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.5.1/css/scroller.dataTables.min.css">
@endpush

@section('content')

  	<!-- START PANEL -->
    <div class="card-title pull-left">Your Memos</div>
    <div class="pull-right">
      <div class="col-xs-12">
        <input type="text" class="search-table form-control pull-right" placeholder="Search">
      </div>
    </div>
    <div class="clearfix"></div>
  	<div class="">

      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#inbox">Memo Inbox &nbsp; <span class="badge badge-danger">{{ $memo_inbox->count() }}</span></a></li>
        <li class=""><a data-toggle="tab" href="#unapproved">Unsent Memos &nbsp; <span class="badge badge-warning">{{ $my_unsent_memos->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Sent Memos &nbsp; <span class="badge badge-success">{{ $my_memos->count() }}</span></a></li>
        
      </ul>
      <div class="tab-content">
        <div id="unapproved" class="tab-pane fade in">
          
            <div class="card-box ">
                <table class="table tableWithSearch nowrap">
                  <thead>
                    <th width="">Subject</th>
                    <th width="30%">Purpose</th>
                    <th width="">Body</th>
                    <th width="">Date</th>
                    <th width="">Comment</th>
                    <th>Status</th>
                    <th>Actions</th>

                  </thead>
                  <tbody>
                    @foreach ( $my_unsent_memos as $memo)
                      <tr>
                        <td>{{ $memo->subject }}</td>
                        <td>{{ $memo->purpose }}</td>
                        <td>
                         <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($memo->body), 50, '...') }}</p> <br>
                          <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info preview_memo"><small>view details</small></a>
                          &nbsp; {!! $memo->attachments->count() > 0 ? '<span class="badge">'. $memo->attachments->count() .' '. str_plural('attachment', $memo->attachments->count()).'</span>' : '<span class="badge">No Attachment</span>'  !!}
                          &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $memo->id ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></td></a> --}}
                        </td>
                        <td>{{ $memo->created_at->toDateTimeString() }}</td>
                        <th>{!! $memo->ApproverComment !!}</th>
                        <td>
                            @if($memo->status() === true) <!-- approved -->
                                <label class="badge badge-success">Approved</label>
                            @else
                                <label class="badge badge-default">{{ $memo->status() }}</label>    
                            @endif
                        </td>
                        <td class="actions" width="130">
                          @if(!$memo->sent())
                          <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" class="btn btn-sm btn-info">Edit </a>
                          <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                          @else
                          <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" class="btn btn-sm disabled ">Edit </a>
                          <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent </a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

        <div id="approved" class="tab-pane fade">

          
          <div class="card-box">
            <table class="table tableWithSearch nowrap">
              <thead>
                <th >Subject</th>
                <th width="30%">Purpose</th>
                <th>Body</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>

              </thead>
              <tbody>
                @foreach ( $my_memos->where('NotifyFlag', 1) as $memo)
                  <tr>
                    <td>{{ $memo->subject }}</td>
                    <td>{{ $memo->purpose }}</td>
                    <td>
                     <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($memo->body), 50, '...') }}</p> <br>
                      <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info preview_memo"><small>view details</small></a>
                      &nbsp; {!! $memo->attachments->count() > 0 ? '<span class="badge">'. $memo->attachments->count() .' '. str_plural('attachment', $memo->attachments->count()).'</span>' : '<span class="badge">No Attachment</span>'  !!}
                      &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $memo->id ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></a> --}}
                    </td>
                    <td>{{ $memo->created_at->toDateTimeString() }}</td>
                    <td>
                        @if($memo->status() === true ) <!-- approved -->
                            <label class="badge badge-success">Approved</label>
                        @else
                            <label class="badge badge-default">{{ $memo->status() }}</label>    
                        @endif
                    </td>
                    <td class="actions" width="130">
                      @if(!$memo->sent())
                      <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" class="btn btn-sm btn-info">Edit </a>
                      <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                      @else
                      <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" class="btn btn-sm disabled ">Edit </a>
                      <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent </a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

        <div id="inbox" class="tab-pane fade in active">

          
          <div class="card-box">
            <table class="table tableWithSearch ">
              <thead>
                <th width="">Subject</th>
                <th width="">Initiator</th>
                    <th width="30%">Purpose</th>
                    <th width="">Body</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>

              </thead>
              <tbody>
                @foreach ($memo_inbox as $memo)
                  <tr>
                    <td>{{ $memo->subject }}</td>
                    <td>{{ $memo->initiator->fullName ?? '-' }}</td>
                    <td>{{ $memo->purpose }}</td>
                    <td>
                     <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($memo->body), 50, '...') }}</p> <br>
                      <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info preview_memo"><small>view details</small></a>
                      &nbsp; {!! $memo->attachments->count() > 0 ? '<span class="badge">'. $memo->attachments->count() .' '. str_plural('attachment', $memo->attachments->count()).'</span>' : '<span class="badge">No Attachment</span>'  !!}
                      &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $memo->id ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></a> --}}
                    </td>
                    <td>{{ $memo->created_at->toDateTimeString() }}</td>
                    <td>
                        @if($memo->status() === true ) <!-- approved -->
                            <label class="badge badge-success">Approved</label>
                        @else
                            <label class="badge badge-default">{{ $memo->status() }}</label>    
                        @endif
                    </td>
                    <td class="actions" width="130">
                      @if(!$memo->processed())
                      <form action="{{ route('process_memo') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $memo->id }}">
                        <button type="submit" class="btn btn-sm btn-success m-r-5" data-toggle="tooltip" title="">Mark as Complete</button>
                      </form>
                      @else
                      <a href="#" class="btn btn-sm btn-success disabled m-r-5" data-toggle="tooltip" title="">Completed</a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

           {{--  <br>

            <table id="example" class="display table " style="width:100%">
                <thead>
                      <tr>
                        <th >Subject</th>
                        <th >Purpose</th>
                        <th>Body</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                </thead>
            </table> --}}

          </div>

        </div>
      </div>
  			

  	</div>
  	<!-- END PANEL -->


    <!-- Modal -->
  <div class="modal fade slide-up" id="show-memo" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <div class="site-logo text-left">
              <img src="{{asset('assets/img/mesllogo.png')}}" width="100px">
            </div> <br>
            <h4 class="semi-bold pull-left">Internal Memo</h4>
            <div class="pull-right">
              <button class="btn btn-default m-r-15 hide-on-print" onclick="print_memo()">Print Memo</button>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-sm-10">
                <p class=""><b>Subject: </b> <span class="memo-subject"></span></p>
                <p class=""><b>Purpose: </b> <span class="memo-purpose"></span></p>
                <p class=""><b>To: </b> <span class="memo-recipients"></span></p>
                <p class=""><b>Approvers: </b> <span class="memo-approvers"></span></p>
                <label class="badge memo-status approved"></label>
              </div>
              <div class="col-sm-2">
                <div class="memo-approved text-right approved"></div>
              </div>
            </div>
          </div> <hr>
          <div class="modal-body memo-body">
            
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="button" class="btn btn-default hide-on-print" data-dismiss="modal">Close</button>
          </div>
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
    

  </script>
@endpush



