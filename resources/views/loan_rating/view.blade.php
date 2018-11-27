@extends('layouts.master')

@push('styles')
  {{-- <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css"> --}}
@endpush

@section('content')
  <div class="card-box">
    <h3 class="card-title">Credit Rating For <span class="m-l-5 text-danger">{{ $rating->customer->Customer }}</span></h3>
    {{-- <div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div> --}}


    <table class="table">
      <thead>
      </thead>
      <tbody>
        <tr>
          <td style="font-weight:bold" width="20%">Customer</td>
          <td>{{ $rating->customer->Customer }}</td>
        </tr>
        <tr>
          <td style="font-weight:bold">Loan Amount</td>
          <td>&#8358;{{ number_format($rating->LoanAmount) }}</td>
        </tr>
        <tr>
          <td style="font-weight:bold">Rate</td>
          <td>{{ MESL\HelpersOld::get_option('Rate', $rating->Rate) }}%</td>
        </tr>
        <tr>
          <td style="font-weight:bold">BusinessLine</td>
          <td>{{ MESL\HelpersOld::get_option('BusinessLine', $rating->BusinessLine) }}</td>
        </tr>
        <tr>
          <td style="font-weight:bold">OfficeAddress</td>
          <td>{{ MESL\HelpersOld::get_option('OfficeAddress', $rating->OfficeAddress) }}</td>
        </tr>
        <tr>
          <td style="font-weight:bold">ResidentialAddress</td>
          <td>{{ MESL\HelpersOld::get_option('ResidentialAddress', $rating->ResidentialAddress) }}</td>
        </tr>
        <tr>
          <td style="font-weight:bold">Purpose</td>
          <td>{{ MESL\HelpersOld::get_option('Purpose', $rating->Purpose) }}</td>
        </tr>
        <tr>
          <td style="font-weight:bold">LoanType</td>
          <td>{{ MESL\HelpersOld::get_option('LoanType', $rating->LoanType) }}</td>
        </tr>
      </tbody>
    </table>


      @if (auth()->id() == $rating->status->UserID)
        <div class="text-center">
          <a href="#" class="btn btn-danger btn-cons" onclick="confirm2('Reject This Loan Profile?', '', 'reject')">Reject</a>
          <a href="#" class="btn btn-success btn-cons m-l-15" onclick="confirm2('Approve This Loan Profile?', '', 'approve')">Approve</a>
        </div>

        <form id="approve" class="hidden" action="{{ route('approve_loan_rating', $rating->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
        </form>
        <form id="reject" class="hidden" action="{{ route('reject_loan_rating', $rating->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
        </form>
      @else

      @endif

  </div>

@endsection
