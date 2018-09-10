@extends('layouts.master')

@section('title')
  Bank Reconciliation Statement 2
@endsection

@section('page-title')
  Bank Reconciliation Statement 2
@endsection

@section('content')

  <style>
    table tbody tr td {
      font-size: 15.5px !important;
    }
  </style>



  <div class="card-box" id="print-content">
      <h3 class="card-title">Bank Reconciliation Statement 2</h3>

      @if ($details)
        <div class="">
          <span class="text-muted bold">Bank:</span> <span class="text-success bold">{{ $details->BankName ?? '' }}</span>
        </div>
        <div class="m-t-10">
          <span class="text-muted bold">Period:</span> From <span class="text-success bold">{{ nice_date($details->StartDate) }}</span> To <span class="text-success bold">{{ nice_date($details->EndDate) }}</span>
        </div>
        <div class="m-t-10">
          <span class="text-muted bold">Opening Balance (Bank):</span> <span>{{ ngn($details->BankOpeningBalance) ?? '' }}</span>
        </div>
        <div class="m-t-10">
          <span class="text-muted bold">Closing Balance (Bank):</span> <span>{{ ngn($details->BankClosingBalance) ?? '' }}</span>
        </div>
        <!-- <div class="m-t-10">
          <span class="text-muted bold">Opening Balance (Officemate):</span> <span>{{ ngn($open_bal->Amount ?? '') ?? '' }}</span>
        </div> -->
      @else
        No reconciliation data uploaded yet.
      @endif

      <table class="table tableWithExportOptions table-bordered font-title">
        <thead>
          <th>GLID</th>
          <th>Description</th>
          {{-- <th>Name</th> --}}
          <th>Amount (&#8358;)</th>
        </thead>

        <tbody>
          @foreach ($rows as $row)
            <tr>
              <td>{{ $row->GLID }}</td>
              <td class="text-uppercase text-inverse">{{ $row->Description }}</td>
              <td class="{{ ($row->Amount < 0)? 'text-danger' : 'text-success' }}">{{ number_format(abs($row->Amount)) }}</td>
            </tr>
          @endforeach
        </tbody>
        {{-- <tfoot>
          <tr>
            <td colspan="" class="text-uppercase text-complete f18" style="border-top:4px double #777">Total<span class="pull-right text-white f18">=</span></td>
            <td class="hidden"></td>
            <td class="text-uppercase text-info f18">&#8358; {{ number_format($cash_flows->sum('Amount')) }}</td>
          </tr>
        </tfoot> --}}
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
  var initTableWithExportOptions = function() {
    var table = $('.tableWithExportOptions');
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
    $('.exportOptions').append('<span class="btn btn-warning btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush
