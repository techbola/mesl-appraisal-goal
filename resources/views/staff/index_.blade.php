@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<button class="btn btn-info" data-toggle="modal" data-target="#new_staff">New Staff</button>
	{{-- </div> --}}
@endsection

@section('page-title')
	Staff Listing
@endsection

@section('content')

	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_staff">New Staff</button>
	</div> --}}

	{{-- Search --}}
	{{-- <div class="card-box">
		<div class="row col-md-offset-1">
			<form action="" method="get">
				<div class="col-md-8">
					<input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Search staff">
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-info btn-block">Search</button>
				</div>
			</form>
		</div>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Staff Listing
		</div>
		{{-- <div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div> --}}
		<div class="clearfix"></div>
		<div class="panel-body">
			<table id="staff_table" class="table table-striped table-bordered">
				<thead>
					<th>Avatar</th>
					<th>Staff Name</th>
					<th>Email Address</th>
					<th>Mobile Number</th>
					<th>Account Status</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach ($staffs as $staff)
						<tr>
						<td>
							<img class="avatar2" src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" alt="" width="48" height="48">
						</td>
						<td><a href="{{ route('staff.show', $staff->StaffRef) }}" title="">{{ $staff->user->FullName ?? '—' }}</a></td>
						<td>{{ $staff->user->email ?? '—' }}</td>
						<td>{{ $staff->MobilePhone ?? '—' }}</td>
						<td>

							@if ($staff->user->is_activated)
								<span class="label label-success">Active</span>
							@elseif ($staff->user->is_disengaged)
								{{-- <span class="label label-danger">Disengaged</span> --}}
							@else
								<span class="label label-warning">Inactive</span>
								<a class="btn btn-xs btn-inverse m-l-5" onclick="confirm2('Re-invite {{ $staff->user->first_name }}?', '', 'invite_{{ $staff->user->id }}')"><i class="fa fa-refresh"></i> ReInvite</a>
								<form id="invite_{{ $staff->user->id }}" class="hidden" action="{{ route('reinvite_staff', $staff->user->id) }}" method="post">
									{{ csrf_field() }}
								</form>
							@endif
							{{-- {{ ($staff->user->is_activated)? '<span class="label label-success">Activated</span>' : '<span class="label label-danger">Not Activated</span>' }} --}}
						</td>
						<td class="actions">
							<a href="{{ route('staff.show', $staff->StaffRef) }}" class="btn btn-xs btn-info">View</a>
							<a href="" class="btn btn-xs btn-inverse" data-toggle="modal" data-target="#edit_staff" @click="edit_staff({{ $staff }})">Edit</a>
							<a href="{{ route('staff.edit_biodata', $staff->StaffRef) }}" class="btn btn-xs btn-inverse">Edit Biodata</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{-- {{ $staffs->links() }} --}}
		</div>
	</div>
	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal - Invite Staff -->
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
							      <label class="req">Supervisor</label>
										{{ Form::select('SupervisorID', [ '' =>  'Select Supervisor'] + $staffs->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "form-control select2", 'data-init-plugin' => "select2"]) }}
							    </div>
							  </div>
								<div class="col-md-12">
									<div class="form-group required">
										<label class="req">Departments</label>
										{{-- <span class="help">Type an email, then press enter or comma.</span> --}}
										{{-- <input name="DepartmentID" class="tagsinput custom-tag-input" type="text" value="" placeholder="."/> --}}

										<select class="form-control select2" name="DepartmentID[]" data-init-plugin="select2" multiple="multiple">
											@foreach ($departments as $dept)
												<option value="{{ $dept->id }}">{{ $dept->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
									 <label class="req">Roles</label>
									 {{ Form::select('roles[]', $roles->pluck('name', 'id')->toArray(),null, ['class'=> "form-control select2", 'data-init-plugin' => "select2", "required", "multiple"]) }}
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
							<button type="submit" class="btn btn-info btn-form">Submit</button>
						</form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->


	<!-- Modal - Invite Staff -->
  <div class="modal fade slide-up disable-scroll" id="edit_staff" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit Staff Details</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

						<form action="" method="post">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}
							<div class="row">
							  <div class="col-md-6">
							    <div class="form-group">
							      <label>First Name</label>
							      <input type="text" class="form-control" name="first_name" placeholder="First Name" required v-model="staff.user.first_name">
							    </div>
							  </div>
							  <div class="col-md-6">
							    <div class="form-group">
							      <label>Last Name</label>
							      <input type="text" class="form-control" name="last_name" placeholder="Last Name" required v-model="staff.user.last_name">
							    </div>
							  </div>

							  <div class="col-md-6">
							    <div class="form-group">
							      <label>Email Address</label>
							      <input type="text" class="form-control" name="email" placeholder="Email Address" required v-model="staff.user.email">
							    </div>
							  </div>
							  <div class="col-md-6">
							    <div class="form-group">
							      <label class="req">Department</label>
										 <select name="DepartmentID" id="DepartmentID" v-model="staff.DepartmentID" class="form-control" data-init-plugin="select2">
										 	<option value="">Select Department</option>
										  	@foreach($departments as $dept)
										  		<option value="{{ $dept->id }}" >{{ $dept->name }}</option>
										  	@endforeach
										  </select>
							    </div>
							  </div>

								{{-- <div class="col-md-12">
									<div class="form-group required">
										<label>Departments</label>
										<select class="form-control select2" name="DepartmentID[]" data-init-plugin="select2" multiple="multiple">
											@foreach ($departments as $dept)
												<option value="{{ $dept->DepartmentRef }}">{{ $dept->Department }}</option>
											@endforeach
										</select>
									</div>
								</div> 

							</div>--}}
							<button type="submit" class="btn btn-info btn-form">Submit</button>
						</form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection


@push('vue')
	<script>
		new Vue({
			el: '#app',
			data: {
				staff: {
					user: {},
				},
			},
			methods: {
				edit_staff(staff){
					this.staff = staff;
					console.log(staff);
					var form_action = "{{ url('/') }}"+"/update_staff_admin/"+staff.StaffRef;
					$('#edit_staff').find('form').attr('action', form_action);
				}
			},
		})
	</script>
@endpush


@push('scripts')
	<script>
		$('#staff_table').DataTable();
	</script>
	{{-- <script>
    $(document).ready(function() {
			var base = '{{ url('/') }}';

      $.get('/get_staff_list', function(data, status){


        $.each(data, function(i, v){
          $('#staff_table tbody').append(`
            <tr>
              <td>
                <img class="avatar2" src="{{ asset('images/avatars/') }}/${v.user.avatar || 'default.png'}" alt="" width="48" height="48">
              </td>
              <td>${v.user.FullName}</td>
              <td>${v.user.email}</td>
              <td>${v.MobilePhone || '—'}</td>
							<td class="actions">
								<a href="${base + '/staff/' + v.StaffRef}" class="btn btn-xs btn-info">View</a>
								<a href="" class="btn btn-xs btn-inverse" data-toggle="modal" data-target="#edit_staff" @click="edit_staff(${v})">Edit</a>
								<a href="${base + '/staff/' + v.StaffRef +'/edit_biodata'}" class="btn btn-xs btn-inverse">Edit Biodata</a>
							</td>
            </tr>
          `);
        });
        $('#staff_table').DataTable();
      });

    });
  </script> --}}
@endpush
