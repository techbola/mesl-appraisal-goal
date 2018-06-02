@extends('layouts.master')

@section('title')
  Issue: {{ $issue->Name }}
@endsection

@section('page-title')
  Title: {{ $issue->Name }}
@endsection

{{-- @section('buttons')
  <button class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#new_issue" @click="new_issue()">New Issue</button>
@endsection --}}

@section('content')

  <div class="card-box">
    <div class="card-title"><span class="text-muted m-r-5">Issue Resolution</span> {{ $issue->Name }}</div>

    <div class=""><b>Description</b></div>
      <div class="">
        {{ $issue->Description }}
      </div>

      <div class="m-t-20"><b>Solution</b></div>
      <div class="f16">
        {!! $issue->Solution !!}
      </div>

  </div>

@endsection
