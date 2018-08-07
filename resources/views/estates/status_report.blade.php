@extends('layouts.master')

@section('title')
	Estate Status Report
@endsection

@section('page-title')
	Estate Status Report
@endsection

@section('buttons')
  <a href="{{ route('estate_info') }}" class="btn btn-sm btn-info">Estate Information</a>
  {{-- <a href="{{ route('estate_allocation') }}" class="btn btn-sm btn-info m-l-5">Estate Allocation</a> --}}
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Estate Status Report</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
    <table class="table table-bordered tableWithSearch">
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
              <td>{{ count($estate->estate_units()->where('EstateInfoID', $status->EstateInfoRef)->get()) }}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- {{ $estates->links() }} --}}
  </div>
@endsection
