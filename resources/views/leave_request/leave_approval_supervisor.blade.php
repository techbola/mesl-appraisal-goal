@extends('layouts.master')

@push('styles')
  <style>
    .tooltip-inner {
    max-width: 200px;
    padding: 20px;
    color: #fff;
    text-align: center;
    text-decoration: none;
    background-color: red;
    border-radius: 4px;
}
  </style>  
@endpush

@section('title')
  Leave Request Approval
@endsection

@section('page-title')
  Leave Request Approval
@endsection

@section('buttons')
  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Request For Leave</a>
@endsection

@section('content')

    <!-- START PANEL -->
    <div class="card-box">
        <div class="card-title pull-left">Leave Request Approval (supervisor)</div>
        <div class="pull-right">
          <div class="col-xs-12">
            <input type="text" class="search-table form-control pull-right" placeholder="Search">
          </div>
        </div>
        <div class="clearfix"></div>
         {{ Form::open(['action' => 'LeaveRequestController@approve_leave_request', 'autocomplete' => 'off', 'role' => 'form']) }}
         <p> 
          {{-- <input type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Approve" name="approve" value="Approve">  --}}
          <!--<button type="submit" name="approve" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-share-square"></i> Approve</button>  -->
          {{-- <input type="submit" name="reject" value="Reject" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject"> --}}
         <!--<button type="submit" name="reject" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-times-circle"></i> Reject</button>-->
        </p>
         <p style="color : red" class="hide">Note : Leave Request highlighted in red are within the company restricted leave days</p>
        <table class="table tableWithSearch table-bordered">
          <thead>
            {{-- <th>Action</th> --}}
            <th>Requester</th>
            <th>Leave Type</th>
            <th>Request Date</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th >Leave Days</th>
            <th>File(s)</th>
            <th>HandOver Notes</th>
            {{-- <th>Action</th> --}}

          </thead>
          <tbody>

            @foreach($leave_check as $leave_request)
                @if($leave_request->status > 0)
              <tr>
                {{-- <td style="background: #fba1a0"> --}}
                  {{-- <input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" > --}}
                {{-- </td> --}}
                <td style="background: #fba1a0">{{$leave_request->first_name}} {{$leave_request->last_name}}  </td>
                <td style="background: #fba1a0">{{$leave_request->LeaveType}}</td>
                <td style="background: #fba1a0">{{nice_date($leave_request->EntryDate)}}</td>
                <td style="background: #fba1a0">{{$leave_request->StartDate}}</td>
                <td style="background: #fba1a0">{{$leave_request->ReturnDate}}</td>
                <td style="background: #fba1a0">{{$leave_request->NumberofDays}}</td>
                <td>
                  @if(!is_null($leave_request->HandOverNote))
                    <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
                  Download attachment
                  @else
                  <span class="badge">No Files</span>
                    @endif
                </td>
                <td>
                  @if($leave_request->handovers->count() > 0)
                  <button class="btn btn-sm show-hon" data-leave_req_id= "{{ $leave_request->LeaveReqRef }}">show notes</button>
                  @else
                  <span class="badge">No HandOver Notes</span>
                  @endif
                </td>
                <td>
                  <a style="margin-right: 10px; display: inline-block" href="/leave_request/approve_request/{{ $leave_request->LeaveReqRef }}"  type="submit"  class="btn btn-sm btn-success toggler" data-whatever="{{ $leave_request->LeaveReqRef }}"  data-placement="top" title="Approve" id="approvers-toggler"><i class="fa fa-send" ></i></a>

                            <a style="margin-right: 10px; display: inline-block" href="{{ '/leave_request/reject_request/'.$leave_request->LeaveReqRef}}" type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject" id="rejection-toggler" data-whatever="{{ $leave_request->LeaveReqRef }}"><i class="fa fa-user-times"></i></a>

                </td>

              </tr>
              @else
              <tr>
                {{-- <td> --}}
                  {{-- <input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" > --}}
                {{-- </td> --}}
                <td>{{$leave_request->first_name}} {{$leave_request->last_name}} </td>
                <td>{{$leave_request->LeaveType}}</td>
                <td>{{nice_date($leave_request->EntryDate)}}</td>
                <td>{{$leave_request->StartDate}}</td>
                <td>{{$leave_request->ReturnDate}}</td>
                <td>{{$leave_request->NumberofDays}}days </td>
                <td>
                  @if(!is_null($leave_request->HandOverNote))
                    <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">

                  Download attachment
                   @else
                  <span class="badge">No Files</span>
                    @endif
                </td>
                <td>
                  @if($leave_request->handovers->count() > 0)
                  <button class="btn btn-sm show-hon" data-leave_req_id= "{{ $leave_request->LeaveReqRef }}">show notes</button>
                  @else
                  <span class="badge">No HandOver Notes</span>
                  @endif

                </td>
                <td>
                  <a style="margin-right: 10px; display: inline-block" href="/leave_request/approve_request/{{ $leave_request->LeaveReqRef }}"  type="submit"  class="btn btn-sm btn-success toggler" data-whatever="{{ $leave_request->LeaveReqRef }}"  data-placement="top" title="Approve" id="approvers-toggler"><i class="fa fa-send" ></i></a>

                            <a style="margin-right: 10px; display: inline-block" href="{{ '/leave_request/reject_request/'.$leave_request->LeaveReqRef}}" type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject" id="rejection-toggler" data-whatever="{{ $leave_request->LeaveReqRef }}"><i class="fa fa-user-times"></i></a>
                </td>
              </tr>
               @endif
              @endforeach
          </tbody>
        </table>
    {{ Form::close() }}
    </div>
    <!-- END PANEL -->


    <div class="modal hon-modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">HandOver Notes</h4>
      </div>
      <div class="modal-body">
        
        <table class="table">
          <thead>
            <th>Task</th>
            <th>Description</th>
            <th>Completion Date</th>
          </thead>

          <tbody class="hon-tbody">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


 <div class="modal fade" role="dialog" id="myModal">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Enter Approval Comment</h4> <hr>
          </div>
          <div class="modal-body">
           <form id="approvers-form" method="post">
            {{ csrf_field() }}
               <div class="row">
                 <div class="controls">
                        <div class="form-group">
                            {{ Form::label('ApproverComment' ) }}
                            <textarea name="ApproverComment" id="Comment" class="form-control summernote" cols="30" rows="10"></textarea>
                        </div>
                    </div>
               </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      </form>
    </div><!-- /.modal -->

    <div class="modal fade" role="dialog" id="myModal_rejection">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Enter reason for rejection</h4> <hr>
          </div>
          <div class="modal-body">
           <form id="rejection-form" method="post">
            {{ csrf_field() }}
               <div class="row">
                 <div class="controls">
                        <div class="form-group">
                            {{ Form::label('RejectionComment' ) }}
                            <textarea name="RejectionComment" id="Comment" class="form-control summernote" cols="30" rows="10"></textarea>
                        </div>
                    </div>
               </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      </form>
    </div><!-- /.modal -->

@endsection

@push('scripts')
  <script>
    $(jQuery(document)).ready(function($) {
     $('#test').tooltip('show');

     $('body').on('click', '.show-hon', function(e) {
       e.preventDefault();
       let leave_req_id = $(this).data('leave_req_id');
       $('.hon-tbody').html('');
       $.get('/fetch-leave-hons/'+leave_req_id, function(data) {
         console.log(data)
         $.each(data, function(index, val) {
            $('.hon-tbody').append(`
              <tr>
                <td>${val.Task}</td>
                <td>${val.Description}</td>
                <td>${val.CompletionDate}</td>
              </tr>
            `);
         });
       });
       // $('.hon-modal table').DataTable();
       $('.hon-modal').modal();

     });
    });
  </script>
  <script>
    $(function(){
       $("#approvers-toggler").click(function(e) {
           e.preventDefault();
           let val = $(this).data('whatever');
           console.log(val);
           $('#myModal').modal();
           $('#approvers-form').prop('action', '/leave_request/approve_request/'+val);
       });


       $("#rejection-toggler").click(function(e) {
           e.preventDefault();
           let val = $(this).data('whatever');
           console.log(val);
           $('#myModal_rejection').modal();
           $('#rejection-form').prop('action', '/leave_request/reject_request/'+val);
       });
    });
</script>
@endpush



