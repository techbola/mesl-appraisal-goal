@extends('layouts.master')
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
        <div class="card-title pull-left">Leave Request Apporoval</div>
        <div class="pull-right">
          <div class="col-xs-12">
            <input type="text" class="search-table form-control pull-right" placeholder="Search">
          </div>
        </div>
        <div class="clearfix"></div>
         {{ Form::open(['action' => 'LeaveRequestController@approve_leave_request', 'autocomplete' => 'off', 'role' => 'form']) }}
         <p><input type="submit" name="approve" class="btn btn-sm btn-primary" value="Approve">  <input type="submit" name="reject" class="btn btn-sm btn-danger" value="Reject"></p>
        <table class="table tableWithSearch table-bordered">
          <thead>
            <th width="10%">Action</th>
            <th width="10%">Requester</th>
            <th width="10%">Leave Type</th>
            <th width="10%">Start Date</th>
            <th width="10%">End Date</th>
            <th width="10%">Leave Days</th>
          </thead>
          <tbody>

            @foreach($leave_requests as $leave_request)
              <tr>
                <td><input type="checkbox" name="LeaveRef[]" value="{{$leave_request->LeaveReqRef}}" required></td>
                <td>{{$leave_request->first_name}} {{$leave_request->last_name}}</td>
                <td>{{$leave_request->LeaveType}}</td>
                <td>{{$leave_request->StartDate}}</td>
                <td>{{$leave_request->ReturnDate}}</td>
                <td>{{$leave_request->NumberofDays}}</td>
              </tr>
              @endforeach
           {{--  @foreach ($memos as $memo)
              <tr>
                <td>{{ $memo->subject }}</td>
                <td>{{ $memo->purpose }}</td>
                <td>{{ str_limit($memo->body,20, '...') }}</td>
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
            @endforeach --}}
          </tbody>
        </table>
    {{ Form::close() }}
    </div>
    <!-- END PANEL -->



@endsection



