@extends('layouts.master')

@section('title')
  Audit Trail
@endsection

@section('page-title')
  Audit Trail
@endsection

@section('buttons')
  <div class="btn btn-sm btn-info pull-right m-b-10" data-toggle="modal" data-target="#new_bulletin">New Bulletin</div>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Audit Trail</div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th>User</th>
        <th>Action</th>
        {{-- <th>Subject</th>
        <th>Properties</th> --}}
        <th>Date</th>
      </thead>
      <tbody>
        @foreach ($logs as $log)
          <tr>
            <td>{{ $log->causer->FullName ?? '' }}</td>
            <td>
              @if ($log->description == 'Logged In')
                <span class="label label-success">{{ $log->description }}</span>
              @elseif ($log->description == 'Logged Out')
                <span class="label label-danger">{{ $log->description }}</span>
              @else
                {{ $log->description }}
              @endif
            </td>
            {{-- <td>{{ $log->subject_type }}</td>
            <td></td> --}}
            <td>{{ ($log->created_at)? $log->created_at->format('jS M, Y - g:iA') : '' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
