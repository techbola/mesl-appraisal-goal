@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<button class="btn btn-info" data-toggle="modal" data-target="#new_staff">New Staff</button>
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_staff">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Staff Listing
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
					<th>Account Status</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach ($staffs as $staff)
						<tr>
						<td><a href="{{ route('staff.show',[$staff->StaffRef]) }}" title="">{{ $staff->user->FullName}}</a></td>
						<td>{{ $staff->user->email }}</td>
						<td>{{ $staff->MobilePhone }}</td>
						<td>
							@if ($staff->user->is_activated)
								<span class="label label-success">Active</span>
							@else
								<span class="label label-danger">Inactive</span>
							@endif
							{{-- {{ ($staff->user->is_activated)? '<span class="label label-success">Activated</span>' : '<span class="label label-danger">Not Activated</span>' }} --}}
						</td>
						<td class="actions">
							<a href="{{ route('staff.show',[$staff->StaffRef]) }}" class="btn btn-sm btn-info">View</a>
							<a href="{{ route('staff.edit_biodata',[$staff->StaffRef]) }}" class="btn btn-sm btn-inverse">Edit</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_staff" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Invite New Staff</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

						<form action="{{ route('invite_staff') }}" method="post">
							{{ csrf_field() }}
							<div class="row">
							  <div class="col-md-6">
							    <div class="form-group">
							      <label>First Name</label>
							      <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
							    </div>
							  </div>
							  <div class="col-md-6">
							    <div class="form-group">
							      <label>Last Name</label>
							      <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
							    </div>
							  </div>

							  <div class="col-md-6">
							    <div class="form-group">
							      <label>Email Address</label>
							      <input type="text" class="form-control" name="email" placeholder="Email Address" required>
							    </div>
							  </div>
							  <div class="col-md-6">
							    <div class="form-group">
							      <label class="req">Role</label>
										{{ Form::select('role', [ '' =>  'Select Role'] + $roles->pluck('name', 'id')->toArray(),null, ['class'=> "form-control select2", 'data-init-plugin' => "select2", "required"]) }}
							    </div>
							  </div>
								<div class="col-md-12">
									<div class="form-group required">
										<label>Departments</label>
										{{-- <span class="help">Type an email, then press enter or comma.</span> --}}
										{{-- <input name="DepartmentID" class="tagsinput custom-tag-input" type="text" value="" placeholder="."/> --}}

										<select class="form-control select2" name="DepartmentID[]" data-init-plugin="select2" multiple="multiple">
											@foreach ($departments as $dept)
												<option value="{{ $dept->DepartmentRef }}">{{ $dept->Department }}</option>
											@endforeach
										</select>
									</div>
								</div>
								@if (auth()->user()->is_superadmin)
									<div class="col-md-6">
										<div class="form-group">
											{{ Form::label('CompanyID', 'Company') }}
			                {{ Form::select('CompanyID', [ '' =>  'Select Company'] + $companies->pluck('Company', 'CompanyRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'required']) }}
										</div>
									</div>
								@endif

							</div>
							<button type="submit" class="btn btn-info">Submit</button>
						</form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection
