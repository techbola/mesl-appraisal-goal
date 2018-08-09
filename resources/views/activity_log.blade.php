@extends('layouts.master')

@section('title')
  Audit Trail
@endsection

@section('page-title')
  Audit Trail
@endsection

@section('buttons')
  <div class="btn btn-sm btn-info pull-right m-b-10" data-toggle="modal" data-target="#new_bulletin">New Bulletin</div>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title pull-left">Audit Trail</div>
    <div class="pull-right">
      <div class="col-xs-12">
        <input type="text" class="search-table form-control pull-right" placeholder="Search">
      </div>
    </div>
    <table class="table table-bordered tableWithSearch tableWithExportOptions" id="print-content">
      <thead>
        <th width="30%">User</th>
        <th width="20%">Action</th>
        {{-- <th>Subject</th>
        <th>Properties</th> --}}
        <th>Date</th>
      </thead>
      <tbody>
        @foreach ($logs as $log)
          <tr>
            <td>{{ $log->causer->FullName ?? '' }}</td>
            <td>
              @if ($log->description == 'Logged In')
                <span class="label label-success">{{ $log->description }}</span>
              @elseif ($log->description == 'Logged Out')
                <span class="label label-danger">{{ $log->description }}</span>
              @else
                {{ $log->description }}
              @endif
            </td>
            {{-- <td>{{ $log->subject_type }}</td>
            <td></td> --}}
            <td>{{ ($log->created_at)? $log->created_at->format('jS M, Y - g:iA') : '' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
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
            "iDisplayLength": 20,
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
    $('.exportOptions').append('<span class="btn btn-info btn-sm btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush
