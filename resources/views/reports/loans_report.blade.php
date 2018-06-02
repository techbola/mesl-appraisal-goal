@extends('layouts.master')

@section('title')
  Loans Report
@endsection

@section('content')

  <style media="screen">
    .account_cat{
      background-color: #10151d !important;
      padding-left: 10px !important;
      font-family: Karla, sans-serif;
      color: #f8d053 !important;
      text-transform: uppercase;
      font-size: 18px !important;
    }
    .account_group {
      /*background-color: #10151d !important;*/
      padding-left: 10px !important;
      font-family: Karla, sans-serif;
      color: #10cfbd !important;
      text-transform: uppercase;
      font-size: 16px !important;
    }
    .total {
      /*background-color: #10151d !important;*/
      font-family: Karla, sans-serif;
      text-transform: uppercase;
      border-top: 4px double darkslategrey;
      font-size: 14px !important;
    }
    .total > td {
      color: #f55753 !important;
    }
    .table tbody tr td {
      font-size: 14.5px;
    }
  </style>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Loans Report</h3>
    </div>
    <div class="panel-body">
      <table class="table tableWithExportOptions">
        <thead>
          <tr>
            <th>Account</th>
            <th>Account Type</th>
            <th>Balance</th>
          </tr>
        </thead>

        <tbody>
          {{-- @foreach ($categories as $cat) --}}
          <!--
            <tr>
              <td colspan="3" class="account_cat"><i class="fa fa-book m-r-10"></i>{{-- $cat->AccountCategory --}}</td>
              <td style="display:none"></td>
              <td style="display:none"></td>
            </tr>
          -->

            {{-- @foreach ($cat->account_groups as $group) --}}
              <tr>
                <td colspan="3" class="account_group">
                  <i class="fa fa-folder-open-o m-r-10"></i>{{ $loan_group->AccountGroup }}
                </td>
                <td style="display:none"></td>
                <td style="display:none"></td>
              </tr>
              @foreach ($loan_group->account_types as $acc_types1)
                <tr>
                  <td class="p-l-35">{{ $acc_types1->AccountType }}</td>
                  <td>{{ $acc_types1->Description }}</td>
                  <td>{{ $acc_types1->totalClearedBalanceFormatted() }}</td>
                </tr>

                  {{-- @if (count($acc_types1->gls) > 0)
                    @foreach ($acc_types1->gls as $accounts1)
                      <tr>
                        <td class="p-l-20">{{ $accounts1->Description }}</td>
                        <td>{{ $accounts1->account_type->AccountType }}</td>
                        <td>{{ $accounts1->currency->Currency }} {{ number_format($accounts1->ClearedBalance) }}</td>
                      </tr>
                    @endforeach
                  @endif --}}

                  {{-- If it has account types but no GLs --}}

                  {{-- @if (empty($acc_types1->gls))
                    <tr>
                      <td style="display:none"></td>
                      <td colspan="3" class="text-center empty">No Records</td>
                      <td style="display:none"></td>
                    </tr>
                  @endif --}}

              @endforeach

              @if (count($loan_group->account_types) > 0 && count($loan_group->gls) > 0)
                <tr class="total">
                  <td class="p-l-20">Total</td>
                  <td></td>
                  <td>{{ $loan_group->totalClearedBalanceFormatted() }}</td>
                </tr>
              @else
                {{-- If it has no account types --}}
                <tr>
                  <td style="display:none"></td>
                  <td colspan="3" class="text-center empty">No Records</td>
                  <td style="display:none"></td>
                </tr>
              @endif

            {{-- @endforeach
          @endforeach --}}
        </tbody>
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
@endpush
