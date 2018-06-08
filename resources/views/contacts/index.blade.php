@extends('layouts.master')

@section('title')
	Business Contacts
@endsection

{{-- @section('page-title')
	Business Contacts
@endsection --}}

@section('buttons')
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_contact">New Contact</button>
@endsection

@section('content')
	<style>
		table tbody td {
			font-size: 14px !important;
		}
		/* table thead th {
			font-size: 14px !important;
			font-weight: bold;
		} */
	</style>

  <div class="card-box">
		<div class="clearfix">
      <div class="card-title pull-left">Business Contacts</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>
    <table id="contacts" class="table table-striped tableWithSearch table-bordered">
      <thead>
        <th width="15%">Name</th>
        <th>Position</th>
        <th>Department</th>
        <th>Organization</th>
        <th width="12%">Phone</th>
				<th width="15%">Email</th>
        <th width="20%">Actions</th>
      </thead>
      <tfoot class="thead">
        <th width="15%">Name</th>
        <th>Position</th>
        <th>Department</th>
        <th>Organization</th>
        <th width="12%">Phone</th>
				<th width="15%">Email</th>
        <th width="20%">Actions</th>
      </tfoot>
      <tbody>
				@foreach ($contacts as $contact)
					<tr>
						<td>{{ $contact->Customer }}</td>
						<td>{{ $contact->Position }}</td>
						<td>{{ $contact->Department }}</td>
						<td>{{ $contact->Organization }}</td>
						<td>{{ $contact->OfficePhone1 }}</td>
						<td>{{ $contact->OfficeEmail }}</td>
						<td>
							{{-- <a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="text-warning f16"><i class="fa fa-pencil"></i></a> --}}
							<a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="btn btn-xs btn-inverse">Edit</a>
							<a href="javascript:void()" data-toggle="modal" data-target="#view_contact" @click="get_contact({{ $contact }})" class="btn btn-xs btn-info">View</a>
							<a href="{{ route('view_call_memo', $contact->CustomerRef) }}" class="btn btn-xs btn-inverse">Meeting Notes</a>
							{{-- <a href="javascript:void()" class="btn btn-xs btn-info">View</a> --}}
						</td>
					</tr>
				@endforeach
      </tbody>
    </table>
  </div>

  @include('contacts.modals')
@endsection

@push('vue')
	<script>

		new Vue({
			el: '#app',
			data: {
				contact: {},
			},
			methods: {
				get_contact(contact) {
					if (contact.AccountFlag == '1') {
						contact.AccountFlag = '<span class="text-success"><b>Yes</b></span>'
					} else {
						contact.AccountFlag = '<span class="text-danger"><b>No</b></span>'
					};
					this.contact = contact;
				},
			},
		});
	</script>
@endpush

@push('scripts')
	<script>
	// var head = $('.table thead tr').clone();
	// $('.table tfoot').append(head);
	//
	// // Setup - add a text input to each footer cell
	//     $('.table tfoot th').each( function () {
	//         var title = $(this).text();
	//         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
	//     } );
	//
	//     // DataTable
	//     var table = $('.table').DataTable();
	//
	//     // Apply the search
	//     table.columns().every( function () {
	//         var that = this;
	//
	//         $( 'input', this.footer() ).on( 'keyup change', function () {
	//             if ( that.search() !== this.value ) {
	//                 that
	//                     .search( this.value )
	//                     .draw();
	//             }
	//         } );
	//     } );
			// $('.table tfoot tr').clone().appendTo('.table thead');


	// 		var settings = {
 //     "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
 //     "sPaginationType": "bootstrap",
 //     "destroy": true,
 //     "scrollCollapse": true,
 //     "oLanguage": {
 //         "sLengthMenu": "_MENU_ ",
 //         "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
 //     },
 //
 //     "iDisplayLength": 20,
 //     "oTableTools": {
 //         "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
 //         "aButtons": [{
 //             "sExtends": "csv",
 //             "sButtonText": "<i class='pg-grid'></i>",
 //         }, {
 //             "sExtends": "xls",
 //             "sButtonText": "<i class='fa fa-file-excel-o'></i>",
 //         }, {
 //             "sExtends": "pdf",
 //             "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
 //         }, {
 //             "sExtends": "copy",
 //             "sButtonText": "<i class='fa fa-copy'></i>",
 //         }]
 //     },
 //     fnDrawCallback: function(oSettings) {
 //         $('.export-options-container').append($('.exportOptions'));
 //     }
 // };

var table = $('#contacts').DataTable();
// var tfoot = $('#contacts thead tr').clone().prop('id', 'tfoot');
// $('#contacts thead').after('<tfoot></tfoot>');
// $('#contacts tfoot').append(tfoot);
			$('#contacts tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#contacts tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="my-input input-sm" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
				$('#contacts tfoot tr').appendTo('#contacts thead');
	</script>
@endpush
