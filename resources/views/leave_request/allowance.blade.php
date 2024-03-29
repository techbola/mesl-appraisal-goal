@extends('layouts.master')

@section('title')
  Leave Allowance Report
@endsection

@section('page-title')
  Leave Allowance Report
@endsection

@section('content')

  {{-- @include('reports.nav') --}}

  <style>
    table tbody tr td {
      font-size: 15.5px !important;
    }
  </style>

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
        <button type="submit" class="btn btn-info m-t-25 btn-cons">Fetch</button>
        {{-- <a href="{{ url()->current() }}" class="btn btn-inverse m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a> --}}
      </div>
    </div>
  </form>

  <div class="card-box" id="print-content">
      <h3 class="card-title">Leave Allowance Report</h3>

      <table class="table tableWithExportOptions table-bordered font-title">
        <thead>
          <th>Fullname</th>
          <th>Leave Type</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Relief Officer</th>
          <th>Leave Days</th>
        </thead>

        <tbody>
          @foreach ($leaves as $row)
            <tr>
              <td>{{  $row->requester->fullName }}</td>
              <td>{{  $row->leave_type->LeaveType  }}</td>
              <td>{{  $row->StartDate  }}</td>
              <td>{{  $row->ReturnDate  }}</td>
              <td>{{  $row->relief_officer->fullName ?? '-'  }}</td>
              <td>{{  $row->NumberofDays  }}</td>
            </tr>
          @endforeach
        </tbody>
        
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
