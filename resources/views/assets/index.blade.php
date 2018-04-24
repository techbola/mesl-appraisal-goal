@extends('layouts.master')

@section('title')
	Company Assets
@endsection

{{-- @section('page-title')
	Company Assets
@endsection --}}

@section('buttons')
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_asset">New Asset</button>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Business Contacts</div>
    <table class="table table-striped tableWithSearch">
      <thead>
        <th width="20%">Name</th>
        <th>Position</th>
        <th>Department</th>
        <th>Organization</th>
        {{-- <th>Address</th> --}}
        {{-- <th>Country</th> --}}
        <th>Phone</th>
				<th>Email</th>
        <th width="10%">Actions</th>
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
							<a href="{{ route('edit_contact', $contact->CustomerRef) }}" class="text-warning f16"><i class="fa fa-pencil"></i></a>
							<a href="javascript:void()" data-toggle="modal" data-target="#view_contact" class="text-primary f16 m-l-10" @click="get_contact({{ $contact }})"><i class="fa fa-eye"></i></a>
						</td>
					</tr>
				@endforeach
      </tbody>
    </table>
  </div>
@endsection
