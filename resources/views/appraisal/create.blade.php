@extends('layouts.master')

@section('content')


<div class="panel panel-default" style="top : 30px; margin-bottom: 60px">
    <div class="panel-heading">
        <div class="panel-title">
            Balance Scorecard
        </div>
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => 'AppraisalItemController@store', 'files' => true, 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('appraisal.form', ['buttonText' => 'Submit'])

		{{ Form::close() }}
    </div>
</div>

@endsection
