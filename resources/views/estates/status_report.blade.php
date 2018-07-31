@extends('layouts.master')

@section('title')
	Estate Status Report
@endsection

@section('page-title')
	Estate Status Report
@endsection

@section('buttons')
  <a href="{{ route('estate_info') }}" class="btn btn-sm btn-info">Estate Information</a>
  <a href="{{ route('estate_allocation') }}" class="btn btn-sm btn-info m-l-5">Estate Allocation</a>
@endsection

@section('content')
  <div class="card-box">
    <table class="table table-bordered">
      <thead>
        <th>Estate Name</th>
        @foreach ($statuses as $status)
          <th>{{ $status->EstateInfo }}</th>
        @endforeach
      </thead>
      <tbody>
        @foreach ($estates as $estate)
          <tr>
            <td>{{ $estate->ProjectName }}</td>
            @foreach ($statuses as $status)
              <td>{{ count($estate->estate_units()->where('EstateInfoID', $status->EstateInfoRef)->get()) }} Units</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $estates->links() }}
  </div>
@endsection
