@extends('layouts.master')

@section('title')
	Business Contacts
@endsection

{{-- @section('page-title')
	Business Contacts
@endsection --}}

@section('buttons')
		<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#new_contact">New Contact</button>
		{{-- <a href="{{ route('conversations_contacts') }}" class="btn btn-info btn-sm m-l-5">Call Contacts</a> --}}
@endsection

@section('content')
	<style>
		table tbody td {
			font-size: 14px !important;
		}

		.modal {
      padding-left: 0 !important
    }

    #new_rel .modal-content, #new_contact .modal-content {
      box-shadow: 0 0 50px #000;
    }

    .form-add-more{
      width: 20px;
      height: 20px;
      line-height: 20px;
      border-radius: 50%;
      text-align: center;
      padding: 0 !important;
      cursor: pointer;
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
				<th width="12%">Email</th>
        <th width="23%">Actions</th>
      </tfoot>
      <tbody>
				@foreach ($contacts as $contact)
					@can ('see-contact', $contact)
						<tr>
							<td>{{ $contact->Customer }}</td>
							<td>{{ $contact->Position }}</td>
							<td>{{ $contact->Department }}</td>
							<td>{{ $contact->Organization }}</td>
							<td>{{ $contact->MobilePhone1 }}</td>
							<td>{{ $contact->OfficeEmail }}</td>
							<td class="actions">
								{{-- <a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="text-warning f16"><i class="fa fa-pencil"></i></a> --}}
								@if ($user->hasRole('admin'))
									<a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="btn btn-xs btn-inverse">Edit</a>
								@endif
								<a href="javascript:void()" data-toggle="modal" data-target="#view_contact" @click="get_contact({{ $contact }})" class="btn btn-xs btn-info">View</a>
								<a href="{{ route('view_call_memo', $contact->CustomerRef) }}" class="btn btn-xs btn-inverse">Meeting Notes</a>
								{{-- <a href="javascript:void()" class="btn btn-xs btn-info">View</a> --}}
								<a href="{{ route('view_conversations', $contact->CustomerRef) }}" class="btn btn-xs btn-info">View Conversations</a>
							</td>
						</tr>
					@endcan
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
var table = $('#contacts').DataTable();

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
