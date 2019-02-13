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
        <div class="card-title pull-left">Leave Request Approval</div>
        <div class="pull-right">
          <div class="col-xs-12">
            <input type="text" class="search-table form-control pull-right" placeholder="Search">
          </div>
        </div>
        <div class="clearfix"></div>
         {{ Form::open(['action' => 'LeaveRequestController@approve_leave_request', 'autocomplete' => 'off', 'role' => 'form']) }}
         <p><button type="submit" name="approve" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-share-square"></i> Approve</button>  
         <button type="submit" name="reject" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-times-circle"></i> Reject</button>
        </p>
         <p style="color : red">Note : Leave Request highlighted in red are within the company restricted leave days</p>
        <table class="table tableWithSearch table-bordered">
          <thead>
            <th>Action</th>
            <th>Requester</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th >Leave Days</th>
            <th>File(s)</th>
            <th>HandOver Notes</th>
          </thead>
          <tbody>

            @foreach($leave_check as $leave_request)
                @if($leave_request->status > 0)
              <tr>
                <td style="background: #fba1a0"><input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" required></td>
                <td style="background: #fba1a0">{{$leave_request->first_name}} {{$leave_request->last_name}} {{ $leave_request->status}} </td>
                <td style="background: #fba1a0">{{$leave_request->LeaveType}}</td>
                <td style="background: #fba1a0">{{$leave_request->StartDate}}</td>
                <td style="background: #fba1a0">{{$leave_request->ReturnDate}}</td>
                <td style="background: #fba1a0">{{$leave_request->NumberofDays}}</td>
                <td>
                  @if(!is_null($leave_request->HandOverNote))
                    <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
<<<<<<< HEAD
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
=======
                  <label class="label label-success"><i class="fa fa-download"></i> Download attachment</label></td>
                    @endif</td>
>>>>>>> 75cd798a9e2558f877338a1d584bab89742b7d2a
              </tr>
              @else
              <tr>
                <td><input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" required></td>
                <td>{{$leave_request->first_name}} {{$leave_request->last_name}} {{ $leave_request->status}}</td>
                <td>{{$leave_request->LeaveType}}</td>
                <td>{{$leave_request->StartDate}}</td>
                <td>{{$leave_request->ReturnDate}}</td>
                <td>{{$leave_request->NumberofDays}}days </td>
                <td>
                  @if(!is_null($leave_request->HandOverNote))
                    <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
<<<<<<< HEAD
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
=======
                  <label class="label label-success"><i class="fa fa-download"></i> Download attachment</label></td>
                    @endif</td>
>>>>>>> 75cd798a9e2558f877338a1d584bab89742b7d2a
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
@endpush



