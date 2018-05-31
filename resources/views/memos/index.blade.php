@extends('layouts.master')
@section('title')
  Memorandum
@endsection

@section('page-title')
  Memorandum
@endsection

@section('buttons')
  <a href="{{ route('memos.create') }}" class="btn btn-info btn-rounded pull-right" >New Memo</a>
@endsection

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
        <li class="active"><a data-toggle="tab" href="#unapproved">Unsent Memos &nbsp; <span class="badge badge-warning">{{ $memos->where('NotifyFlag', 0)->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Sent Memos &nbsp; <span class="badge badge-success">{{ $memos->where('NotifyFlag', 1)->count() }}</span></a></li>
      </ul>
      <div class="tab-content">
        <div id="unapproved" class="tab-pane fade in active">
          
            <div class="card-box ">
                <table class="table tableWithSearch">
                  <thead>
                    <th width="5%">Subject</th>
                    <th width="5%">Purpose</th>
                    <th width="25%">Body</th>
                    <th>Status</th>
                    <th>Actions</th>

                  </thead>
                  <tbody>
                    @foreach ( $memos->where('NotifyFlag', 0) as $memo)
                      <tr>
                        <td>{{ $memo->subject }}</td>
                        <td>{{ $memo->purpose }}</td>
                        <td>
                          {!! str_limit($memo->body,50, '...') !!} <br>
                          <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info"><small>Read More</small></a>
                        </td>
                        <td>
                            @if($memo->status() == 1) <!-- approved -->
                                <label class="label label-success">Approved</label>
                            @else
                                <label class="label label-default">{{ $memo->status() }}</label>    
                            @endif
                        </td>
                        <td class="actions">
                          @if(!$memo->sent())
                          <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                          @else
                          <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent <i cla></i></a>
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
            <table class="table tableWithSearch">
              <thead>
                <th width="5%">Subject</th>
                <th width="5%">Purpose</th>
                <th>Body</th>
                <th>Status</th>
                <th>Actions</th>

              </thead>
              <tbody>
                @foreach ( $memos->where('NotifyFlag', 1) as $memo)
                  <tr>
                    <td>{{ $memo->subject }}</td>
                    <td>{{ $memo->purpose }}</td>
                    <td>
                      {!! str_limit($memo->body,50, '...') !!} <br>
                      <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info preview_memo"><small>Read More</small></a>
                    </td>
                    <td>
                        @if($memo->status() == 1) <!-- approved -->
                            <label class="label label-success">Approved</label>
                        @else
                            <label class="label label-default">{{ $memo->status() }}</label>    
                        @endif
                    </td>
                    <td class="actions">
                      @if(!$memo->sent())
                      <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" class="btn btn-sm btn-info">Edit </a>
                      <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                      @else
                      <a href="{{ route('memos.edit', ['id' => $memo->id ]) }}" class="btn btn-sm disabled ">Edit </a>
                      <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent <i cla></i></a>
                      @endif
                    </td>
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
  <div class="modal fade slide-up disable-scroll" id="show-memo" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold">Internal Memo</h4>
            <div class="row">
              <div class="col-sm-6">
                <h5 class="memo-subject"></h5>
                <p class=""><b>Purpose: </b> <span class="memo-purpose"></span></p>
                <p class=""><b>Approvers: </b> <span class="memo-approvers"></span></p>
                <label class="label memo-status"></label>
              </div>
              <div class="col-sm-6">
                <div class="memo-approved text-right"></div>
              </div>
            </div>
          </div> <hr>
          <div class="modal-body memo-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->



@endsection

@push('scripts')
  <script>
    $(function(){
      $('.preview_memo').click(function(e) {
        e.preventDefault();
        let url = $(this).prop('href');
                  $("#show-memo").find('.memo-subject').html(' ');
          $("#show-memo").find('.memo-purpose').html(' ');
          $("#show-memo").find('.memo-status').html(' ');
          $("#show-memo").find('.memo-approvers').html(' ');
          $("#show-memo").find('.memo-body').html(' ');
          $("#show-memo").find('.memo-approved').html(' ');
        $.get(url, function(data) {
          // activate modal
          $("#show-memo").find('.memo-subject').html(data.subject);
          $("#show-memo").find('.memo-purpose').html(data.purpose);
          $("#show-memo").find('.memo-status').html(data.status);
          $("#show-memo").find('.memo-approvers').html(data.approvers);
          $("#show-memo").find('.memo-body').html(data.body);
          $("#show-memo").modal('show');
          if(data.approved == true){
            $("#show-memo").find('.memo-approved').html('<img src="{{ asset('images/checkmark.svg') }}" width="100">');
          }
        });
      });
    });
  </script>
@endpush



