@extends('layouts.master')

@section('title')
  Loan Schedule Status
@endsection

@section('content')
  <style>
    table tbody tr td {
      font-size: 15.5px !important;
    }
  </style>

  <div id="spinner" style="display: none; padding-top:40vh" class="text-center">
		<img src="{{ asset('assets/img/spinner.gif') }}" alt="" width="40px">
	</div>

  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20"> {{--  style="width:70%; margin:0 auto 20px auto" --}}
      <div class="col-md-3 col-md-offset-1">
        <label>From</label>
        <div class="input-group date dp">
          <input type="text" name="from" class="form-control" value="{{ $from ?? '' }}">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
      <div class="col-md-3">
        <label>To</label>
        <div class="input-group date dp">
          <input type="text" name="to" class="form-control" value="{{ $to ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
      {{-- <div class="col-md-4 col-md-offset-2">
        <label>End Date:</label>
        <div class="input-group date dp">
          <input type="text" name="to" class="form-control" value="{{ $to ?? '' }}" required>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div> --}}
      <div class="col-md-4">
        <label></label>
        <button type="submit" class="btn btn-complete m-t-25 btn-cons">Fetch</button>
        <a href="{{ url()->current() }}" class="btn btn-info m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a>
      </div>
    </div>
  </form>

  <div class="panel panel-default" id="print-content">
    <div class="panel-heading">
      <h3 class="panel-title">Loan Schedule Status Report</h3>
      <div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table tableWithSearch tableWithExportOptions table-bordered">
        <thead>
          <tr>
            <th width="15%">Name</th>
            <th>Principal Due (&#8358;)</th>
            <th>Interest Due (&#8358;)</th>
            <th>Account Balance (&#8358;)</th>
            <th>Total Due (&#8358;)</th>
            <th>Excess Short Fall (&#8358;)</th>
            <th>Loan Acct</th>
            <th>Personal Acct</th>
            <th width="10%">Payment Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($loans as $loan)
            <tr>
              <td>{{ $loan->FirstName }} {{ $loan->MiddleName }} {{ $loan->LastName }}</td>
              <td>{{ number_format($loan->PrincipalDue, '2') }}</td>
              <td>{{ number_format($loan->InterestDue, '2') }}</td>
              <td>{{ number_format($loan->AccountBalance, '2') }}</td>
              <td>{{ number_format($loan->TotalAmountDue, '2') }}</td>
              <td class="{{ ($loan->ExcessShortfall >= 0)? 'text-success':'text-danger' }}">{{ number_format($loan->ExcessShortfall, '2') ?? '' }}</td>
              <td>{{ $loan->LoanAcctRef }}</td>
              <td>{{ $loan->PersonalAcctRef }}</td>
              <td>{{ $loan->PymntDate }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="" class="table-total">TOTAL</td>
            <td class="table-total2 {{ ($loans->sum('PrincipalDue') >= 0)? 'text-success':'text-danger' }}">&#8358;{{ number_format($loans->sum('PrincipalDue'), '2') }}</td>

            <td class="table-total2 {{ ($loans->sum('InterestDue') >= 0)? 'text-success':'text-danger' }}">&#8358;{{ number_format($loans->sum('InterestDue'), '2') }}</td>

            <td class="table-total2 {{ ($loans->sum('AccountBalance') >= 0)? 'text-success':'text-danger' }}">&#8358;{{ number_format($loans->sum('AccountBalance'), '2') }}</td>

            <td class="table-total2 {{ ($loans->sum('TotalAmountDue') >= 0)? 'text-success':'text-danger' }}">&#8358;{{ number_format($loans->sum('TotalAmountDue'), '2') }}</td>

            <td class="table-total2 {{ ($loans->sum('ExcessShortfall') >= 0)? 'text-success':'text-danger' }}">&#8358;{{ number_format($loans->sum('ExcessShortfall'), '2') }}</td>
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
    $('.exportOptions').addClass("m-t-10 m-b-10").append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>

@endpush
