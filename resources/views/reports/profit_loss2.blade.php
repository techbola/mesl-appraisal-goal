@extends('layouts.master')

@section('title')
  Profit and Loss Report
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

  <div id="spinner" style="display: none; padding-top:40vh" class="text-center">
		<img src="{{ asset('assets/img/spinner.gif') }}" alt="" width="40px">
	</div>

  {{-- <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">

      <div class="col-md-4 col-md-offset-2">
        <label>End Date:</label>
        <div class="input-group date dp">
          <input type="text" name="to" class="form-control" value="{{ $to ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
      <div class="col-md-4">
        <label></label>
        <button type="submit" class="btn btn-complete m-t-25 btn-cons">Fetch</button>
        <a href="{{ url()->current() }}" class="btn btn-info m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a>
      </div>
    </div>
  </form> --}}
  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20" style="width:80%; margin:0 auto 20px auto">
      <div class="col-md-4">
        <div class="form-group">
          <label>From</label>
          <div class="input-group date dp">
            <input type="text" name="from" class="form-control" value="{{ $from ?? '' }}" required>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>To</label>
          <div class="input-group date dp">
            <input type="text" name="to" class="form-control" value="{{ $to ?? '' }}" required>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
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
      <h3 class="panel-title">
        Profit and Loss Report
        @if (empty($from) && empty($to))

        @elseif (empty($from))
            <span class="small" style="text-transform: capitalize"> — As at {{ date('jS M, Y', strtotime($to)) }}</span>
        @else
            <span class="small" style="text-transform: capitalize"> — From {{ date('jS M, Y', strtotime($from)) }} to {{ date('jS M, Y', strtotime($to)) }}</span>
        @endif
      </h3>
    </div>
    <div class="panel-body">
      <table class="table tableWithExportOptions">
        <thead>
          <tr>
            <th>Account Type</th>
            <th>Description</th>
            <th>Balance</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($categories as $cat)
            <tr>
              <td colspan="3" class="account_cat"><i class="fa fa-book m-r-10"></i>{{ $cat->AccountCategory }}</td>
              <td style="display:none"></td>
              <td style="display:none"></td>
            </tr>

            @foreach ($cat->account_groups as $group)
              <tr>
                <td colspan="3" class="account_group">
                  <i class="fa fa-folder-open-o m-r-10"></i>{{ $group->AccountGroup }}
                </td>
                <td style="display:none"></td>
                <td style="display:none"></td>
              </tr>
              @foreach ($group->account_types as $acc_types1)
                <tr>
                  <td class="p-l-35">{{ $acc_types1->AccountType }}</td>
                  <td>{{ $acc_types1->Description }}</td>
                  <td>
                    @if (empty($from) && empty($to))
                      {{ $acc_types1->txBalanceFormatted() }}
                    @elseif (empty($from))
                      {{ $acc_types1->txBalanceFormatted(null, $to) }}
                    @else
                      {{ $acc_types1->txBalanceFormatted($from, $to) }}
                    @endif
                  </td>
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

              @if (count($group->account_types) > 0 && count($group->gls) > 0)
                <tr class="total">
                  <td class="p-l-20">Total</td>
                  <td></td>
                  <td>
                    @if (empty($from) && empty($to))
                      {{ $group->txBalanceFormatted() }}
                    @elseif (empty($from))
                      {{ $group->txBalanceFormatted(null, $to) }}
                    @else
                      {{ $group->txBalanceFormatted($from, $to) }}
                    @endif
                  </td>
                </tr>
              @else
                {{-- If it has no account types --}}
                <tr>
                  <td style="display:none"></td>
                  <td colspan="3" class="text-center empty">No Records</td>
                  <td style="display:none"></td>
                </tr>
              @endif

            @endforeach
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" class="text-uppercase text-complete f18" style="border-top:4px double #777">Total<span class="pull-right text-white f18">=</span></td>
            <td class="hidden"></td>
            <td class="text-uppercase text-complete f18">&#8358; {{ number_format($totalPL) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

@endsection

@push('scripts')

  <link href="{{ asset('assets/plugins/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js') }}"></script>

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
    $('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush
