@extends('layouts.master')

@section('title')
  {{-- Task - {{ $task->Task }} --}}
@endsection

@section('page-title')
  Assigned To-Dos
@endsection

@section('buttons')
  <a class="btn btn-sm btn-info btn-rounded" href="{{ route('todos_calendar') }}"><i class="fa fa-calendar m-r-5"></i> Back to Calendar</a>
@endsection

@section('content')
  {{-- <div class="">

  </div> --}}
@endsection
