@extends('layouts.master')

@section('content')
<div class="card-box">
    <div class="panel-heading">
        <div class="panel-title">
            Edit Leave Request
        </div>
    </div>
    <div class="panel-body">
        {{ Form::model($leave_request, ['action' => ['LeaveRequestController@update', $leave_request->LeaveReqRef ], 'autocomplete' => 'off', 'role' => 'form']) }}
        {{ method_field('PATCH') }}
        @include('leave_request.form', ['buttonText' => 'Save'])
        {{ Form::close() }}
    </div>
</div>
@endsection