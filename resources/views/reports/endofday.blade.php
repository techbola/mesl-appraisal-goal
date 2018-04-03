@extends('layouts.master')

@section('title')
  End Of Day
@endsection

@section('content')
  <div class="panel panel-default text-center">
    <div class="panel-heading" style="border-bottom: 1px solid #444">
      <h3 class="panel-title f20">End Of Day</h3>
    </div>
    {{-- <hr> --}}
    <div class="panel-body">
      <a href="#" class="m-t-20 m-b-20 btn btn-success btn-lg btn-cons text-center" style="min-width:200px" onclick="confirm2('Run end of day?', '<span class=\'text-danger\'>This action is irreversible.</span>', 'eod_form')">Execute</a>

      <form id="eod_form" class="hidden" action="{{ route('run_endofday') }}" method="post">
        {{ csrf_field() }}
      </form>
    </div>
  </div>
@endsection
