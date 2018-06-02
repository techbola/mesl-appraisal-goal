@extends('layouts.master')
@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Assign Roles to Users
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'UserRoleAssignmentController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group select2">
						{{ Form::label('user_id', 'Select Employee') }}
						{{ Form::select('user_id', ['' => ''] + $users->pluck('email', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select employee", 'data-init-plugin' => "select2"]) }}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group select2">
						{{ Form::label('role_id', 'Select Role') }}
						{{ Form::select('role_id', ['' => ''] + $roles->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select employee's role", 'data-init-plugin' => "select2"]) }}
				</div>
			</div>
		</div> <br>

		<div class="row">
			<div class="pull-right">
				{{-- 
				{{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent' ]) }} --}}
				{{ Form::submit('Create Role',[ 'class' => 'btn btn-complete' ]) }}

			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('bottom-content')
<section class="bg-white container-fluid container-fixed">
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">Role Assignment Table</div>
			<div class="btn-group pull-right m-b-10">
				<button type="button" class="btn btn-default">Bulk Actions</button>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Edit</a></li>
					<li><a href="#">Send to trash</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed dataTable ">
					<thead>
						<tr>
							<th style="width:5%">
								<div class="checkbox ">
									<input type="checkbox" value="3" id="checkbox-all">
									<label for="checkbox-all"></label>
								</div>
							</th>
							<th style="width:10%">Name</th>
							<th style="width:10%">Display Name</th>
							<th style="width:10%">Description</th>
							<th style="width:20%"></th>
						</tr>
					</thead>
					<tbody>
						{{-- @foreach( $roles as $role) --}}

						{{-- @endforeach --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
