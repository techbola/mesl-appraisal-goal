@extends('layouts.master')


@section('content')

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Subordinates
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<table class="table tableWithSearch table-striped table-bordered">
				<thead>
					<th>Staff Name</th>
					<th>Email Address</th>
					<th>Mobile Number</th>
					<th>Office Location</th>
					{{-- <th>Account Status</th>
					<th>Actions</th> --}}
				</thead>
				<tbody>
					@foreach ($staffs as $staff)
						<tr>
						<td>
							@if (auth()->user()->hasRole('admin'))
								<a href="{{ route('staff.show', $staff->StaffRef) }}" title="">{{ $staff->user->FullName}}</a>
							@else
								{{ $staff->user->FullName}}
							@endif
						</td>
						<td>{{ $staff->user->email }}</td>
						<td>{{ $staff->MobilePhone }}</td>
						<td>{{ $staff->location->Location ?? '—' }}</td>
						{{-- <td>
							@if ($staff->user->is_activated)
								<span class="label label-success">Active</span>
							@else
								<span class="label label-danger">Inactive</span>
								<a class="btn btn-xs btn-inverse m-l-5" onclick="confirm2('Re-invite {{ $staff->user->first_name }}?', '', 'invite_{{ $staff->user->id }}')"><i class="fa fa-refresh"></i> ReInvite</a>
								<form id="invite_{{ $staff->user->id }}" class="hidden" action="{{ route('reinvite_staff', $staff->user->id) }}" method="post">
									{{ csrf_field() }}
								</form>
							@endif
						</td>
						<td class="actions">
							<a href="{{ route('staff.show',[$staff->StaffRef]) }}" class="btn btn-xs btn-info">View</a>
							<a href="" class="btn btn-xs btn-inverse" data-toggle="modal" data-target="#edit_staff" @click="edit_staff({{ $staff }})">Edit</a>
							<a href="{{ route('staff.edit_biodata',[$staff->StaffRef]) }}" class="btn btn-xs btn-inverse">Edit Biodata</a>
						</td> --}}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->

@endsection


@push('vue')

@endpush
