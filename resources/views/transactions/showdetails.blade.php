@extends('layouts.master')

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="panel panel-default" id="print-content">
		<div class="panel-heading">
				<div class="panel-title">
					Account statement
				</div>
				<div class="pull-right">
					<div class="col-xs-12">
						{{-- <input type="text" class="search-table form-control pull-right" placeholder="Search"> --}}
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<table class="table tableWithExportOptions" id="transactions">
					<thead>
						<th>Refrence No</th>
						<th>Account Name</th>
						<th>Account Type</th>
						<th>Currency</th>
						<th>Cleared Balance</th>
						<th>Book Balance</th>
						<th>Action</th>
					</thead>
					<tfoot class="thead">
						<th>Refrence No</th>
						<th>Customer</th>
						<th>Account Type</th>
						<th>Currency</th>
						<th>Cleared Balance</th>
						<th>Book Balance</th>
						<th>Action</th>
					</tfoot>
					<tbody>
						@foreach($statements as $statement)
						<tr>
							<td>{{$statement->GLID}}</td>
							<td>{{$statement->Customer}}</td>
							<td>{{$statement->AccountType}}</td>
							<td>{{$statement->Currency}}</td>
							<td>{{number_format($statement->ClearedBalance,2)}}</td>
							<td>{{number_format($statement->BookBalance,2)}}</td>
							<td class="actions">
								<a href="{{route('transactions.show',[$statement->GLID]) }}" class="btn btn-info">View Statement</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- END PANEL -->
	</div>
	@endsection


	@push('scripts')
<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
<script>
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
	// $('#transactions').editableTableWidget();
  // $(document).ready(function(){
  	 var settings = {
    "sDom": "<'exportOptions pull-right'T><'table-responsive't><'row'<p i>>",
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
     // "columnDefs": [
     //        {
     //            "targets": [ 3 ],
     //            "visible": false
     //        }
     //    ],
    "iDisplayLength": 20,
    "oTableTools": {
        "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
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
    }
};


var table = $('#transactions').DataTable(settings);
 $('#transactions tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
  // });
</script>

{{-- <script>
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
</script> --}}

<script>
	$('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
</script>
@endpush
