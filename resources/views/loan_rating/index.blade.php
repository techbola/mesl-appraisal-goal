@extends('layouts.master')

@push('styles')
  {{-- <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css"> --}}
@endpush

@section('buttons')
  <a href="{{ route('new_loan_rating') }}" class="btn btn-info btn-rounded">+ New Credit Rating</a>
@endsection

@section('content')
  {{-- <div class="pull-right m-b-20">
    <a href="{{ route('new_loan_rating') }}" class="btn btn-success">New Credit Rating</a>
  </div>
  <div class="clearfix"></div> --}}

  <div class="card-box">
      <h3 class="card-title pull-left">Credit Ratings</h3>
      <div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
    <div class="panel-body">

      <table class="table table-bordered tableWithSearch">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Loan Amount</th>
            <th>Rate</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Credit Score</th>
            <th>Status</th>
            <th>Waiting For</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ratings as $rating)
            <tr>
              <td>{{ $rating->customer->Customer }}</td>
              <td>&#8358;{{ number_format($rating->LoanAmount) }}</td>
              <td>{{ $Rate->{App\HelpersOld::num_words($rating->Rate)} }}%</td>
              <td>{{ $rating->customer->OfficePhone1 ?? '-' }}</td>
              <td>{{ $rating->customer->OfficeEmail ?? '-' }}</td>
              <td>{{ $rating->PercentScore }}% ({{ $rating->Score }})</td>
              <td>{{ $rating->status->Status }}</td>
              <td>{{ $rating->status->reviewer->name ?? '-' }}</td>
              <td>
                <a href="{{ route('view_loan_rating', $rating->id) }}" class="btn btn-sm btn-info">View</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
@endsection
