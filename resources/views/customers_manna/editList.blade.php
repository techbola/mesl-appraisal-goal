@extends('layouts.master')

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Edit Customer Details
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table" id="customer">
				<thead>
					<th>Lastname</th>
                    <th>Middlename</th>
                    <th>Firstname</th>
					<th>Contact Phone</th>
					<th>Occupation</th>
					<th>Email</th>
					<th></th>
				</thead>
				<tfoot class="thead">	
						<th>Lastname</th>
                    <th>Middlename</th>
                    <th>Firstname</th>
						<th>Contact Phone</th>
						<th>Occupation</th>
						<th>Email</th>
						<th style="display: none;"></th>
					</tfoot>
				<tbody>
					@foreach ($customers as $customer)
						<tr>
						<td>{{ $customer->LastName}}</td>
						<td><b>{{ $customer->MiddleName}}</b></td>
                        <td><b>{{ $customer->FirstName}}</b></td>
						<td>{{ $customer->Telephone }}</td>
						<td>{{ $customer->Occupation }}</td>
						<td>{{ $customer->Email }}</td>
						<td class="actions">
							<a href="{{ route('customers.edit',[$customer->CustomerRef]) }}" class="btn btn-info">Edit</a>
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
@endpush