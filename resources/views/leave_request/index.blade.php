@extends('layouts.master')
@section('title')
  Leave Request
@endsection

@section('page-title')
  Leave request
@endsection

@section('buttons')
  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Request For Leave</a>
@endsection

@section('content')

    <!-- Modal - Invite Staff -->
  <div class="modal fade slide-up  " id="edit_leave_request" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Modify Leave Request</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

            <form action="{{ route('invite_staff') }}" method="post">
              {{ csrf_field() }}
              @include('leave_request.form', ['buttonText' => 'Save'])
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            </form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Leave Status</div>
  			<div class="pull-right">
  				<div class="col-xs-12">
  					<input type="text" class="search-table form-control pull-right" placeholder="Search">
  				</div>
  			</div>
  			<div class="clearfix"></div>
  			
        <table class="table tableWithSearch table-bordered">
          <thead>
            <th width="10%">Leave Type</th>
            <th width="7%">Start Date</th>
            <th width="7%">End Date</th>
            <th width="5%">Leave Days</th>
            <th width="12%">Awaiting Approval</th>
            <th width="15%">Action</th>
          </thead>
          <tbody>

            @foreach($leave_requests as $leave_request)
                <tr>
                <td>{{$leave_request->leave_type->LeaveType}}</td>
                <td>{{$leave_request->StartDate}}</td>
                <td>{{$leave_request->ReturnDate}}</td>
                <td>{{$leave_request->NumberofDays}}</td>
                <td>
                  @if($leave_request->NotifyFlag == 1 && $leave_request->RejectionFlag != 1 && is_null($leave_request->ApproverID) && $leave_request->CompletedFlag == 1 )
                  <label class="label label-success"> Your Leave Request Awaits HR Approval. </label>
                  @else
                    @if($leave_request->NotifyFlag == 0 && $leave_request->RejectionFlag != 1)
                    <label class="label label-default">Leave Request has not been sent for approval.</label>
                  @elseif($leave_request->NotifyFlag == 1 && $leave_request->RejectionFlag != 1)
                    <label class="label label-default"> pending with {{$leave_request->user->first_name ?? ''}} {{$leave_request->user->last_name ?? ''}}</label>
                  @else
                  <label class="label label-danger"> Rejected by {{$leave_request->user->first_name ?? ''}} {{$leave_request->user->last_name ?? ''}}</label>
                  @endif
                  @endif
                </td>
                <td>
                  @if($leave_request->NotifyFlag == 0)
                  <a href="/leave_request/{{ $leave_request->LeaveReqRef }}/edit" class="btn btn-xs btn-complete " data-request_ref = "{{ $leave_request->LeaveReqRef }}" >Edit Request</a> 
                  | <a href="#" class="btn btn-xs btn-success" data-id="{{$leave_request->LeaveReqRef}}" onclick="send_notification()">Send for Approval</a>
                  @elseif($leave_request->NotifyFlag == 1 && $leave_request->RejectionFlag != 1 && is_null($leave_request->ApproverID) && $leave_request->CompletedFlag == 1)
                    <p><i style="font-size: 12px; color: green">Completed</i></p>
                  @else
                    <p><i style="font-size: 12px; color: green">Request can't be edited again</i></p>
                  @endif 
                </td>
              </tr>
              @endforeach
          </tbody>
        </table> 

  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
  <script>
    function send_notification()
        {
          var elem = this.event.target;
          var elem_value = $(elem).attr('data-id');
            $.get('/leave_notification/'+elem_value, function(data, status) {
              if(status == 'success')
              {
                window.location.href = '{{ route('LeaveDashBoard') }}'
              }
            });


        }
  </script>
@endpush


