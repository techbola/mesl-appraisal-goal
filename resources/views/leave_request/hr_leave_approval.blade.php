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


    <ul class="nav nav-tabs outside">
        
        <li class="active">
            <a data-toggle="tab" href="#unapproved-request">
                Unapproved Request &nbsp; <span class="badge badge-success">
                    {{-- {{ count($staff_onboarding_sent) }} --}}
                </span>
            </a>
        </li>
        <li >
            <a data-toggle="tab" href="#approved-request">
                Approved Request &nbsp; <span class="badge badge-warning"></span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
      <div id="approved-request" class="tab-pane fade in">
          <div class="clearfix"></div>
          <!-- START PANEL -->
          <div class="card-box">
            <div class="card-title pull-left">Leave Request Approval</div>
            <div class="pull-right">
              <div class="col-xs-12">
                <input type="text" class="search-table form-control pull-right" placeholder="Search">
              </div>
            </div>
            <div class="clearfix"></div>
            {{ Form::open(['action' => 'LeaveRequestController@approve_leave_request_hr', 'autocomplete' => 'off', 'role' => 'form']) }}
            {{-- <p><input type="submit" name="approve" class="btn btn-sm btn-primary" value="Approve">  <input type="submit" name="reject" class="btn btn-sm btn-danger" value="Reject"></p> --}}
            <p style="color : red" class="hide">Note : Leave Request highlighted in red are within the company restricted leave days</p>
            <table class="table tableWithSearch nowrap table-bordered">
              <thead>
                <th width="10%">Action</th>
                <th width="10%">Requester</th>
                <th width="10%">Leave Type</th>
                <th width="10%">Start Date</th>
                <th width="10%">End Date</th>
                <th width="10%">Relief Officer</th>
                <th width="10%">Leave Days</th>
                <th width="10%">File(s)</th>
                <th width="10%">Allowance</th>
                <th width="10%">Line Manager</th>
                <th width="10%">HR Approver</th>
              </thead>
              <tbody>

                @foreach($leave_check->where('CompletedFlag', 1) as $leave_request)
                    @if($leave_request->status > 0)
                  <tr>
                    <td style="background: #fba1a0">
                      @if($leave_request->CompletedFlag == 1)
                      <span class="badge badge-success">Completed</span>
                      @else
                      <input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" >
                      @endif
                    </td>
                    <td style="background: #fba1a0">{{$leave_request->first_name}} {{$leave_request->last_name}} </td>
                    <td style="background: #fba1a0">{{$leave_request->LeaveType}}</td>
                    <td style="background: #fba1a0">{{$leave_request->StartDate}}</td>
                    <td style="background: #fba1a0">{{$leave_request->ReturnDate}}</td>
                    <td>{{ $leave_request->relief_officer ?? '-'  }}</td>
                    <td style="background: #fba1a0">{{$leave_request->NumberofDays}} </td>
                    <td>
                      @if(!is_null($leave_request->HandOverNote))
                        <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
                      Download attachment
                        @endif
                    </td>
                    <td>{{$leave_request->PayAllowance ?? '-'}}</td>
                  </tr>
                  @else
                  <tr>
                    <td>
                      @if($leave_request->CompletedFlag == 1)
                      <span class="badge badge-success">Completed</span>
                      @else
                      <input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" >
                      @endif
                    </td>
                    <td>{{$leave_request->first_name}} {{$leave_request->last_name}}</td>
                    <td>{{$leave_request->LeaveType}}</td>
                    <td>{{$leave_request->StartDate}}</td>
                    <td>{{$leave_request->ReturnDate}}</td>
                    <td>{{ $leave_request->relief_officer ?? '-'  }}</td>
                    <td>{{$leave_request->NumberofDays}}days</td>
                    </td>
                    <td>
                      @if(!is_null($leave_request->HandOverNote))
                        <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
                      Download attachment
                      @else
                      <span class="badge">No Files</span>
                        @endif
                    </td>
                    <td>{{$leave_request->PayAllowance ?? '-'}}</td>
                    <td>{{$leave_request->line_manager ?? '-'}}</td>
                    <td>{{$leave_request->hr_staff}}</td>
                  
                  </tr>
                  @endif
                  @endforeach
              </tbody>
            </table>
            {{ Form::close() }}
          </div>
          <!-- END PANEL -->
      </div>
      
      <div id="unapproved-request" class="tab-pane active">
        <div class="card-box">
            <div class="card-title pull-left">Incomplete Request</div>
            <div class="pull-right">
              <div class="clear-fix"></div>
              <div class="col-xs-12">
                <input type="text" class="search-table form-control pull-right" placeholder="Search">
              </div>
            </div>
            <div class="clearfix"></div>
            {{ Form::open(['action' => 'LeaveRequestController@approve_leave_request_hr', 'autocomplete' => 'off', 'role' => 'form']) }}
              <p><input type="submit" name="approve" class="btn btn-sm btn-primary" value="Approve">  <input type="submit" name="reject" class="btn btn-sm btn-danger" value="Reject"></p>
              <p style="color : red" class="hide">Note : Leave Request highlighted in red are within the company restricted leave days</p>
              <table class="table tableWithSearch nowrap table-bordered">
                <thead>
                  <th width="10%">Action</th>
                  <th width="10%">Requester</th>
                  <th width="10%">Leave Type</th>
                  <th width="10%">Start Date</th>
                  <th width="10%">End Date</th>
                  <th>Relief Officer</th>
                  <th width="10%">Leave Days</th>
                  <th width="10%">File(s)</th>
                  <th width="10%">Allowance</th>
                  <th width="10%">Comment</th>

                </thead>
                <tbody>

                  @foreach($leave_check->where('CompletedFlag', 0) as $leave_request)
                      @if($leave_request->status > 0)
                    <tr>
                      <td style="background: #fba1a0">
                        
                        <input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" >
                      
                      </td>
                      <td style="background: #fba1a0">{{$leave_request->first_name}} {{$leave_request->last_name}} </td>
                      <td style="background: #fba1a0">{{$leave_request->LeaveType}}</td>
                      <td style="background: #fba1a0">{{$leave_request->StartDate}}</td>
                      <td style="background: #fba1a0">{{$leave_request->ReturnDate}}</td>
                      <td>{{ $leave_request->relief_officer ?? '-' }}</td>
                      <td style="background: #fba1a0">{{$leave_request->NumberofDays}} </td>
                      <td>
                        @if(!is_null($leave_request->HandOverNote))
                          <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
                        Download attachment
                          @endif
                      </td>
                      <td>{{$leave_request->PayAllowance ?? '-'}}</td>
                      <td>
                        <textarea name="Comment" id="Comment" class="form-control"></textarea>
                      </td>
                    </tr>
                    @else
                    <tr>
                      <td>
                       
                        <input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" >
                      
                      </td>
                      <td>{{$leave_request->first_name}} {{$leave_request->last_name}}</td>
                      <td>{{$leave_request->LeaveType}}</td>
                      <td>{{$leave_request->StartDate}}</td>
                      <td>{{$leave_request->ReturnDate}}</td>
                      <td>{{ $leave_request->relief_officer ?? '-' }}</td>
                      <td>{{$leave_request->NumberofDays}}days</td>
                      </td>
                      <td>
                        @if(!is_null($leave_request->HandOverNote))
                          <a href="{{ asset( 'storage/leave_document/'.$leave_request->HandOverNote)}}" class="btn btn-xs btn-success" target="_blank">
                        Download attachment
                        @else
                        <span class="badge">No Files</span>
                          @endif
                      </td>
                      <td>{{$leave_request->PayAllowance ?? '-'}}</td>
                      <td>
                        <textarea name="Comment[{{ $leave_request->LeaveReqRef }}]" id="Comment" class="form-control"></textarea>
                      </td>
                    
                    </tr>
                    @endif
                    @endforeach
                </tbody>
              </table>
            {{ Form::close() }}
        </div>
      </div>

    </div>     
   
@endsection

@push('scripts')
  <script>
    $(jQuery(document)).ready(function($) {
     $('#test').tooltip('show');
    });
  </script>
@endpush



