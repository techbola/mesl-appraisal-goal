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
    <table class="table table-striped tableWithSearch table-bordered">
      <thead>
        <th width="15%">Name</th>
        <th>Position</th>
        <th>Department</th>
        <th>Organization</th>
        {{-- <th>Address</th> --}}
        {{-- <th>Country</th> --}}
        <th width="12%">Phone</th>
				<th width="20%">Email</th>
        <th width="15%">Actions</th>
      </thead>
      <tbody>
				@foreach ($contacts as $contact)
					<tr>
						<td>{{ $contact->Customer }}</td>
						<td>{{ $contact->Position }}</td>
						<td>{{ $contact->Department }}</td>
						<td>{{ $contact->Organization }}</td>
						{{-- <td>{{ $contact->Address }}</td> --}}
						{{-- <td>{{ $contact->country->Country }}</td> --}}
						<td>{{ $contact->OfficePhone1 }}</td>
						<td>{{ $contact->OfficeEmail }}</td>
						<td>
							{{-- <a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="text-warning f16"><i class="fa fa-pencil"></i></a> --}}
							<a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="btn btn-xs btn-inverse">Edit</a>
							<a href="javascript:void()" data-toggle="modal" data-target="#view_contact" @click="get_contact({{ $contact }})" class="btn btn-xs btn-info">View</a>
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
					this.contact = contact;
				},
			},
		});
	</script>
@endpush
