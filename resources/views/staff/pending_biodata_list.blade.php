@extends('layouts.master')

@section('title')
  Pending Bio-data Edits
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Pending Bio-data Edits</div>
    <table class="table tableWithSearch table-striped table-bordered">
      <thead>
        <tr>
          <th>Staff</th>
          <th>Edited By</th>
          <th>Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pendings as $pending)
          <tr>
            <td>{{ $pending->user->FullName ?? '-' }}</td>
            <td>{{ $pending->user->FullName ?? '-' }}</td>
            <td>{{ $pending->created_at->format('jS M, Y') }}</td>
            <td>
              <a href="{{ route('pending_biodata', $pending->id) }}" class="btn btn-sm btn-inverse">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
