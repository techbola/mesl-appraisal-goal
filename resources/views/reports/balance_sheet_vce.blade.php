@extends('layouts.master')

@section('title')
  Balance Sheet
@endsection

@section('content')

  <style>

    table tbody tr td {
      font-size: 15.5px !important;
    }
  </style>

  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">
      <div class="col-md-4 col-md-offset-1">
        <label>End Date:</label>
        <div class="input-group date dp">
          <input type="text" name="date" class="form-control" value="{{ $date ?? '' }}" required>
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
      <h3 class="panel-title">Balance Sheet</h3>
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
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$fixed->AccountCategoryRef, $date]) }}">{{ $fixed->AccountCategory }}</a></td>
              <td>{{ number_format($fixed->Amount) }}</td>
            </tr>
            <tr>
              <td class="text-complete"></td>
              <td>{{ number_format($fixed->Amount) }}</td>
            </tr>
            <tr>

            </tr>
            <tr>
              <td>Current Assets</td>
              <td></td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$debtors->AccountCategoryRef, $date]) }}">{{ $debtors->AccountCategory }}</a></td>
              <td>{{ number_format($debtors->Amount) }}</td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$cash->AccountCategoryRef, $date]) }}">{{ $cash->AccountCategory }}</a></td>
              <td>{{ number_format($cash->Amount) }}</td>
            </tr>
            <tr>
              <td></td>
              <td>{{ number_format($current_assets) }}</td>
            </tr>
            <tr>
              <td>Amount Falling Due Within One Year</td>
              <td></td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$creditors->AccountCategoryRef, $date]) }}">{{ $creditors->AccountCategory }}</a></td>
              <td>{{ number_format($creditors->Amount) }}</td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$tax->AccountCategoryRef, $date]) }}">{{ $tax->AccountCategory }}</a></td>
              <td>{{ number_format($tax->Amount) }}</td>
            </tr>
            <tr>
              <td></td>
              <td>{{ number_format($amount_falling) }}</td>
            </tr>
            <tr>
              <td>Net Current Asset</td>
              <td>{{ number_format($net_current) }}</td>
            </tr>
            <tr>
              <td>Net Worth</td>
              <td>{{ number_format($net_current + $fixed->Amount) }}</td>
            </tr>
            <tr>
              <td>Represented By</td>
              <td></td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$capital->AccountCategoryRef, $date]) }}">{{ $capital->AccountCategory }}</a></td>
              <td>{{ number_format($capital->Amount) }}</td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$reserves->AccountCategoryRef, $date]) }}">{{ $reserves->AccountCategory }}</a></td>
              <td>{{ number_format($reserves->Amount) }}</td>
            </tr>
            <tr>
              <td class="text-complete"><a href="{{ route('bsdetails', [$directors->AccountCategoryRef, $date]) }}">{{ $directors->AccountCategory }}</a></td>
              <td>{{ number_format($directors->Amount) }}</td>
            </tr>
            <tr>
              <td>Shareholder's Funds</td>
              <td>{{ number_format($shareholders) }}</td>
            </tr>

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
