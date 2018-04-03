@extends('layouts.master')

@section('content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="panel panel-default" id="print-content">
		<div class="panel-heading">
			<div class="panel-title">
			Customer Listing
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table tableWithExportOptions" id="customer">
				<thead>
					<th>Account Number</th>
					<th>Customer Name</th>
					<th>Account Type</th>
					<th>Contact Phone</th>
					<th>Occupation</th>
					<th>Email</th>
					<th></th>
				</thead>
				<tfoot class="thead">
						<th>Account Number</th>
						<th>Customer Name</th>
						<th>Account Type</th>
						<th>Contact Phone</th>
						<th>Occupation</th>
						<th>Email</th>
						<th style="display: none;"></th>
					</tfoot>
				<tbody>
					@foreach ($customers as $customer)
						<tr>
						<td>{{ $customer->GLRef}}</td>
						<td><b>{{ $customer->Customer}}</b></td>
						<td><b>{{ $customer->AccountType}}</b></td>
						<td>{{ $customer->Telephone }}</td>
						<td>{{ $customer->Occupation }}</td>
						<td>{{ $customer->Email }}</td>
						<td class="actions">
							<a href="{{ route('customers.show',[$customer->CustomerRef]) }}" class="btn btn-info">View Customer Details</a>
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
    "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
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
    "iDisplayLength": 5,
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


var table = $('#customer').DataTable(settings);
 $('#customer tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#customer tfoot th')) {
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
	$('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
</script>
@endpush
