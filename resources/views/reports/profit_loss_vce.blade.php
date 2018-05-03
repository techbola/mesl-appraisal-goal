@extends('layouts.master')

@section('title')
  Profit And Loss
@endsection

@section('content')

  <style>
    .total {
      border-top: 3px double #ccc;
      border-bottom: 3px double #ccc;
    }
  </style>

  <style>
    table tbody tr td {
      font-size: 15.5px !important;
    }
  </style>

  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">
      <div class="col-md-2 col-md-offset-1">
        <label>From Date:</label>
        <div class="input-group date dp">
          <input type="text" name="from" class="form-control" value="{{ $from ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
      <div class="col-md-2">
        <label>To Date:</label>
        <div class="input-group date dp">
          <input type="text" name="to" class="form-control" value="{{ $to ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
      <div class="col-md-6">
        <label></label>
        <button type="submit" class="btn btn-complete m-t-25 btn-cons">Fetch</button>
        <a href="{{ url()->current() }}" class="btn btn-info m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a>
        <a href="" class="btn btn-info m-t-25 btn-cons" data-toggle="modal" data-target="#period">Accounting Period</a>
      </div>
    </div>
  </form>

  @include('reports.modal_period')

  <div class="panel panel-default" id="print-content">
    <div class="panel-heading">
      <h3 class="panel-title">Profit And Loss</h3>
    </div>
    <div class="panel-body">

      <table class="table tableWithExportOptions2 table-bordered font-title">
        <thead>
          <th>Name</th>
          <th>Balance (&#8358;)</th>
        </thead>

        <tbody>
          {{-- @foreach ($data as $bs) --}}
            {{-- {{ dd($bs->AccountCategory) }} --}}
            @if (!empty($fee))
              <tr>
                <td class="text-complete"><a href="{{ route('pldetails', [$fee->AccountCategoryRef, $to]) }}">{{ $fee->AccountCategory }}</a></td>
                <td>{{ number_format($fee->Amount) }}</td>
              </tr>
            @endif
            @if (!empty($other))
              <tr>
                <td class="text-complete"><a href="{{ route('pldetails', [$other->AccountCategoryRef, $to]) }}">{{ $other->AccountCategory }}</a></td>
                <td>{{ number_format($other->Amount) }}</td>
              </tr>
            @endif

            <tr>
              <td class="text-complete"></td>
              <td>{{ number_format($fee_other) }}</td>
            </tr>
            @if (!empty($cost))
              <tr>
                <td class="text-complete"><a href="{{ route('pldetails', [$cost->AccountCategoryRef, $to]) }}">{{ $cost->AccountCategory }}</a></td>
                <td>{{ number_format($cost->Amount) }}</td>
              </tr>
            @endif

            <tr>
              <td>Gross Profit / (Loss)</td>
              <td>{{ number_format($gross_profit) }}</td>
            </tr>
            @if (!empty($expense))
              <tr>
                <td class="text-complete"><a href="{{ route('pldetails', [$expense->AccountCategoryRef, $to]) }}">{{ $expense->AccountCategory }}</a></td>
                <td>{{ number_format($expense->Amount) }}</td>
              </tr>
            @endif

            <tr>
              <td>Profit/(Loss) Before Tax</td>
              <td>{{ number_format($before_tax) }}</td>
            </tr>
            @if (!empty($provision))
              <tr>
                <td class="text-complete"><a href="{{ route('pldetails', [$provision->AccountCategoryRef, $to]) }}">{{ $provision->AccountCategory }}</a></td>
                <td>{{ number_format($provision->Amount) }}</td>
              </tr>
            @endif

            <tr>
              <td>Profit/(Loss) After Tax</td>
              <td>{{ number_format($after_tax) }}</td>
            </tr>
            @if (!empty($reserve))
              <tr>
                <td class="text-complete"><a href="{{ route('pldetails', [$reserve->AccountCategoryRef, $to]) }}">{{ $reserve->AccountCategory }}</a></td>
                <td class="total">{{ number_format($reserve->Amount) }}</td>
              </tr>
            @endif


        </tbody>
        {{-- <tfoot>
          <tr>
            <td colspan="2" class="text-uppercase text-complete f18" style="border-top:4px double #777">Total<span class="pull-right text-white f18">=</span></td>
            <td class="hidden"></td>
            <td class="text-uppercase text-danger f18">&#8358; {{ number_format($tbs->sum('DebitBalance')) }}</td>
            <td class="text-uppercase text-success f18">&#8358; {{ number_format($tbs->sum('CreditBalance')) }}</td>
          </tr>
        </tfoot> --}}
      </table>
    </div>
  </div>
@endsection

@push('scripts')

  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
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
  var initTableWithExportOptions = function() {
    var table = $('.tableWithExportOptions2');
        var settings = {
          "order": [],
            "sDom": "<'exportOptions pull-right'T><'table-responsive't><'row'<p i>>",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 5000,
            "oTableTools": {
                "sSwfPath": "/assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                "aButtons": [{
                    "sExtends": "csv",
                    "sButtonText": "<i class='pg-grid'></i>",
                }, {
                    "sExtends": "xls",
                    "sButtonText": "<i class='fa fa-file-excel-o'></i>",
                }, {
                    "sExtends": "pdf",
                    "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
                }, {
                    "sExtends": "copy",
                    "sButtonText": "<i class='fa fa-copy'></i>",
                }]
            },
            fnDrawCallback: function(oSettings) {
                $('.export-options-container').append($('.exportOptions'));
                $('#ToolTables_tableWithExportOptions_0').tooltip({
                    title: 'Export as CSV',
                    container: 'body'
                });
                $('#ToolTables_tableWithExportOptions_1').tooltip({
                    title: 'Export as Excel',
                    container: 'body'
                });
                $('#ToolTables_tableWithExportOptions_2').tooltip({
                    title: 'Export as PDF',
                    container: 'body'
                });
                $('#ToolTables_tableWithExportOptions_3').tooltip({
                    title: 'Copy data',
                    container: 'body'
                });
            }
        };
        table.dataTable(settings);
  }
  initTableWithExportOptions();
  </script>

  <script>
    $('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush
