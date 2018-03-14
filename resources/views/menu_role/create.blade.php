@extends('layouts.master')
@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Assign Menu to Roles
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'MenuRoleAssignmentController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group form-group-default select2">
						{{ Form::label('menus', 'Select Menus') }}
						{{ Form::select('menus[]',[ 0 =>  'Select Menu'] + $menus->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => " Select Menus", 'data-init-plugin' => "select2"]) }}
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group form-group-default required select2">
						{{ Form::label('role_id', 'Select Role') }}
						{{ Form::select('role_id', [ 0 =>  'Select a role'] + $roles->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select a role", 'data-init-plugin' => "select2"]) }}
				</div>
			</div>
		</div> <br>

		<div class="row">
			<div class="pull-right">
				{{ Form::submit('Assign Menus',[ 'class' => 'btn btn-complete ' ]) }}
				{{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
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
			<div class="panel-title">Table Title</div>
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
							<th style="width:10%">Roles</th>
							<th style="width:10%">Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($roles as $role)
							<tr>
								<td></td>
								<td></td>
								<td></td>
														
							</tr>	
							@endforeach			
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
