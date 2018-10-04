@extends('layouts.master')

@push('styles')

<style>
	tfoot{
      display: table-header-group;
     }
</style>

@endpush

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="panel panel-default" id="print-content">
		<div class="panel-heading">
			<div class="panel-title">
				Customer Account Statement.
			</div><hr>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
				@if(isset($statements))
					@foreach($trans as $tran)
						<div class="col-md-4"><p style ="font-size :17px">Name :</p></div>
						<div class="col-md-8"><p style ="font-size :17px; color : #0090d9">{{$tran->Customer}}</p></div>
					@if(!empty($tran->HomeAddress))
					<div class="col-md-4"><p style ="font-size :17px">Address :</p></div>
					<div class="col-md-8">
					<p style ="font-size :17px; color : #0090d9">{{$tran->HomeAddress}}</p>
					</div>
					@endif
					@if(!empty($tran->Telephone))
					<div class="col-md-4"><p style ="font-size :17px">Phone Number :</p></div>
					<div class="col-md-8"><p style ="font-size :17px; color : #0090d9">{{ $tran->Telephone}}</p></div><br>
					@endif
					@if(!empty($tran->BVN))
					<div class="col-md-4"><p style ="font-size :17px">BVN Number :</p></div>
					<div class="col-md-8"><p style ="font-size :17px; color : #0090d9">{{$tran->BVN}}</p></div>
					@endif
				</div>

				<div class="col-md-6">
					<div class="col-md-5"><p style ="font-size :17px">Account No :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{$tran->AccountNumber}}</p></div>
					<div class="col-md-5"><p style ="font-size :17px">Account Type :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{$tran->AccountType}}</p></div>
					<div class="col-md-5"><p style ="font-size :17px">Currency :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{$tran->Currency}}</p></div><br>
					<div class="col-md-5"><p style ="font-size :17px">Book Balance :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{ number_format( $tran->BookBalance,2)}}</p></div><br>
					<div class="col-md-5"><p style ="font-size :17px">Cleared Balance :</p></div>
					<div class="col-md-7"><p style ="font-size :17px; color : #0090d9">{{ number_format( $tran->ClearedBalance,2)}}</p></div>
					@endforeach
					@endif
				</div>
			</div><hr>
			<div class="table-responsive">
				<table class="table tableWithExportOptions" id="transactions">
				<thead>
					<th>Transaction Date</th>
					<th>Value Date</th>
					<th>Debits</th>
					<th>Credits</th>
					<th>Balance</th>
					<th>Naration</th>
				</thead>
				<tfoot class="thead">
						<th>Transaction Date</th>
					<th>Value Date</th>
					<th>Debits</th>
					<th>Credits</th>
					<th>Balance</th>
					<th>Naration</th>
					</tfoot>
				<tbody>
				@if(isset($statements))
					@foreach($statements as $statement)
					<tr>
						<td>{{$statement->PostDate}}</td>
						<td>{{$statement->ValueDate}}</td>
						<td>{{number_format($statement->Debit,2) }}</td>
						<td>{{number_format($statement->Credit,2) }}</td>
						<td>{{number_format($statement->Balance,2) }}</td>
						<td>{{$statement->Narration}}</td>
					</tr>
					@endforeach
				@endif
				</tbody>
			</table>
			</div>
		</div>
	</div><br><br>
	<!-- END PANEL -->

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
    // "sDom": "<'exportOptions pull-right'T><'table-responsive't><'row'<p i>>",
    sDom: 'lfrB<"pull-right">tip',
buttons: [
            'copy', 'excel', 'pdf', 'print', {
                extend: 'colvis',
                columns: ':gt(0)',
                text: 'Columns'
            }
        ],
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
    // "oTableTools": {
    //     "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
    //     "aButtons": [{
    //         "sExtends": "csv",
    //         "sButtonText": "<i class='pg-grid'></i>",
    //     }, {
    //         "sExtends": "xls",
    //         "sButtonText": "<i class='fa fa-file-excel-o'></i>",
    //     }, {
    //         "sExtends": "pdf",
    //         "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
    //     }, {
    //         "sExtends": "copy",
    //         "sButtonText": "<i class='fa fa-copy'></i>",
    //     }]
    // },
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
