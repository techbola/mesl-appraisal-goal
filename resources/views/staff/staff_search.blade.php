@extends('layouts.master')

@section('title')
  Staff Search
@endsection

@section('content')
  {{-- Search --}}
  <div class="card-box">
    <div class="row col-md-offset-1">
      <form action="" method="get">
        <div class="col-md-8">
          <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Search staff">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-info btn-block">Search</button>
        </div>
      </form>
    </div>
  </div>

  <!-- START PANEL -->
  <div class="card-box">
    {{-- <div class="card-title pull-left">
      Staff Listing
    </div>
    <div class="pull-right">
      <div class="col-xs-12">
        <input type="text" class="search-table form-control pull-right" placeholder="Search">
      </div>
    </div>
    <div class="clearfix"></div> --}}
    <div class="panel-body">
      <table id="staff_table" class="table table-striped table-bordered">
        <thead>
          <th>Avatar</th>
          <th>Staff Name</th>
          <th>Email Address</th>
          <th>Mobile Number</th>
          <th>Office Location</th>
          {{-- <th>Account Status</th>
          <th>Actions</th> --}}
        </thead>
        <tbody>
          @foreach ($staffs as $staff)
            <tr>
              <td>
                <img class="avatar2" src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" alt="" width="48" height="48">
              </td>
              <td>{{ $staff->user->FullName ?? '—' }}</td>
              <td>{{ $staff->user->email ?? '—' }}</td>
              <td>{{ $staff->MobilePhone ?? '—' }}</td>
              <td>{{ $staff->OfficeLocation ?? '—' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $staffs->links() }}
    </div>
  </div>
@endsection

@push('scripts')
  {{-- <script>
    $(document).ready(function() {

      $.get('/get_staff_list', function(data, status){


        $.each(data, function(i, v){
          $('#staff_table tbody').append(`
            <tr>
              <td>
                <img class="avatar2" src="{{ asset('images/avatars/') }}" alt="" width="48" height="48">
              </td>
              <td>${v.user.FullName}</td>
              <td>${v.user.email}</td>
              <td>${v.MobilePhone || '-'}</td>
            </tr>
          `);
        });
        $('#staff_table').DataTable();
      });

    });
  </script> --}}
@endpush
