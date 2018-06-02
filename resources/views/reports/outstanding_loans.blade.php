@extends('layouts.master')

@section('title')
  Running Loans Report
@endsection

@section('content')
  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">
      <div class="col-md-4 col-md-offset-2">
        <label>Loan Type:</label>
        <select class="select2 form-control" name="type" data-init-plugin="select2" required>
          <option value="">Select one</option>
          @foreach ($types as $type)
            <option value="{{ $type->AccountTypeRef }}" {{ (!empty($get_type) && $get_type == $type->AccountTypeRef)? 'selected':'' }}>{{ $type->AccountType }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label></label>
        <button type="submit" class="btn btn-complete m-t-25 btn-cons">Fetch</button>
        <a href="{{ url()->current() }}" class="btn btn-info m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a>
      </div>
    </div>
  </form>

  <div class="panel panel-default" id="print-content">
    <div class="panel-heading">
      <h3 class="panel-title">Running Loans Report</h3>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table tableWithExportOptions">
        <thead>
          <tr>
            <th width="5%">GLRef</th>
            <th>Customer</th>
            <th>Loan Type</th>
            <th>Loan Amount (&#8358;)</th>
            <th>Total Paid (&#8358;)</th>
            <th>Outstanding (&#8358;)</th>
            <th>Loan Date</th>
            <th>Maturity Date</th>
            <th>Maturity (Days)</th>
          </tr>
        </thead>
        <tbody>


          @foreach ($accounts as $account)
            <tr>
              <td>{{ $account->GLRef }}</td>
              <td class="text-complete font-title" style="font-size:15px">{{ $account->customer->Customer }}</td>
              <td>{{ $account->account_type->AccountType }}</td>
              <td>{{ number_format($account->LoanAmount) }}</td>
              <td class="text-success">{{ $account->Outstanding }}</td>
              {{-- <td class="text-danger">{{ number_format($account->ClearedBalance * -1) }}</td> --}}
              <td class="{{ ($account->ClearedBalance < 0)? 'text-danger':'text-success' }}" data-sort="{{ $account->ClearedBalance }}">{{ number_format(abs($account->ClearedBalance)) }}</td>
              <td>{{ $account->LoanDate }}</td>
              <td>{{ $account->LoanMaturityDate }}</td>
              <td>{{ $account->LoanMaturityDays }}</td>
            </tr>
          @endforeach

        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-uppercase f16 font-title text-white">Total</td>
            <td class="hidden"></td>
            <td class="hidden"></td>
            <td class="f16 font-title text-white">&#8358; {{ number_format($accounts->sum('LoanAmount')) }}</td>
            <td class="f16 font-title text-white">&#8358; {{ number_format($accounts->sum('LoanAmount') + $accounts->sum('ClearedBalance')) }}</td>
            <td class="f16 font-title text-white">&#8358; {{ number_format($accounts->sum('ClearedBalance') * -1) }}</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    var table = $('.tableWithSearch');
    var settings = {
      "order": [[ 1, "asc" ]],
        "sDom": "<'table-responsive't><'row'<p i>>",
        "destroy": true,
        "scrollCollapse": true,
        "oLanguage": {
            "sLengthMenu": "_MENU_ ",
            "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
        },
        "iDisplayLength": 20
    };
    table.dataTable(settings);
  </script>

  <script>
  var initTableWithExportOptions = function() {
    var table = $('.tableWithExportOptions');
        var settings = {
          "order": [],
            "sDom": "<'exportOptions pull-right m-t-10 m-b-10'T><'table-responsive't><'row'<p i>>",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 200,
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
