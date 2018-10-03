@extends('layouts.master')

@section('title')
  Trial Balance Report
@endsection

@section('page-title')
  Trial Balance
@endsection

@section('content')

  @include('reports.nav')

  <style>
    table tbody tr td {
      font-size: 15.5px !important;
    }
  </style>

  <div id="spinner" style="display: none; padding-top:40vh" class="text-center">
		<img src="{{ asset('assets/img/spinner.gif') }}" alt="" width="40px">
	</div>

  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">
      <div class="col-md-4">
        <label>From Date:</label>
        <div class="input-group date dp">
          <input type="text" name="from" class="form-control" value="{{ $date ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>

      <div class="col-md-4 ">
        <label>End Date:</label>
        <div class="input-group date dp">
          <input type="text" name="to" class="form-control" value="{{ $date ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>

      <div class="col-md-4">
        <label></label>
        <button type="submit" class="btn btn-info m-t-25 btn-cons">Fetch</button>
        <a href="{{ url()->current() }}" class="btn btn-inverse m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a>
      </div>
    </div>
  </form>

  <div class="card-box" id="print-content">
      <h3 class="card-title">Trial Balance Report</h3>

      <div class="clearfix">

      </div>

      <table class="table tableWithExportOptions table-bordered font-title">
        <thead>
          <th>Category</th>
          <th>Ledger Items</th>
          <th>Debit Balance (&#8358;)</th>
          <th>Credit Balance (&#8358;)</th>
        </thead>

        <tbody>
          @foreach ($tbs as $tb)
            <tr>
              <td class="text-uppercase text-complete">{{ $tb->AccountCategory }}</td>
              <td class="text-uppercase text-complete">{{ $tb->TrialBalanceName }}</td>
              <td>{{ number_format($tb->DebitBalance) }}</td>
              <td>{{ number_format($tb->CreditBalance) }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="1" class="text-uppercase text-complete f18" style="border-top:4px double #777">Total<span class="pull-right text-white f18">=</span></td>
            <td></td>
            <td class="text-uppercase text-danger f18">&#8358; {{ number_format($tbs->sum('DebitBalance')) }}</td>
            <td class="text-uppercase text-success f18">&#8358; {{ number_format($tbs->sum('CreditBalance')) }}</td>
          </tr>
        </tfoot>
      </table>
  </div>
@endsection

@push('scripts')

  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

  <script>
      $(function(){
          var options = {
              todayHighlight: true,
              format: 'yyyy-mm-dd',
              autoclose: true,
          };
           $('.dp').datepicker(options);
      })
  </script>

  <script>
  </script>

  <script>
    $('.exportOptions').append('<span class="btn btn-warning btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush
