@extends('layouts.master')

@section('title')
  Savings Accounts
@endsection

@section('content')
  <style media="screen">
    table tr td {
      font-size: 16px !important;
    }
  </style>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Savings Account Report</h3>
      <div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table tableWithSearch tableWithExportOptions table-bordered font-title">
        <thead>
          <th>Name</th>
          <th>Account Balance (&#8358;)</th>
        </thead>
        <tbody>
          @foreach ($accounts as $account)
            <tr>
              <td>{{ $account->FirstName ?? '' }} {{ $account->MiddleName ?? '' }} {{ $account->LastName ?? '' }}</td>
              <td data-sort="{{ $account->Balance }}">{{ number_format($account->Balance) }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="" class="text-uppercase text-complete f18" style="border-top:4px double #777">Total<span class="pull-right text-white f18">=</span></td>
            {{-- <td class="hidden"></td>
            <td class="text-uppercase text-danger f18">&#8358; {{ number_format($tbs->sum('DebitBalance')) }}</td> --}}
            <td class="text-uppercase text-success f18">&#8358; {{ number_format($accounts->sum('Balance')) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
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
            "iDisplayLength": 15,
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
    $('.exportOptions').addClass('m-t-10 m-b-10').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush
