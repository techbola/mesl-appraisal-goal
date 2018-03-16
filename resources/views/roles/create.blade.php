@extends('layouts.master')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			Create Role
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'RoleController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('roles.form', ['buttonText' => 'Create Roles'])
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('bottom-content')
<section class="container-fluid container-fixed">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-title">Manage Roles</div>
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
				<table class="table dataTable">
					<thead>
						<tr>
							{{-- <th style="width:5%">
								<div class="checkbox ">
									<input type="checkbox" value="3" id="checkbox-all">
									<label for="checkbox-all"></label>
								</div>
							</th> --}}
							<th>Name</th>
							<th>Display Name</th>
							<th>Company</th>
							<th>Description</th>
							<th style="width:20%">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $roles as $role)
						<tr>
							{{-- <td class="v-align-middle">
								<div class="checkbox ">
									<input type="checkbox" value="3" id="checkbox-{{$role->id}}">
									<label for="checkbox-{{$role->id}}"></label>
								</div>
							</td> --}}
							<td class="v-align-middle"> {{ $role->name }} </td>
							<td class="v-align-middle">{{ $role->display_name}}</td>
							<td class="v-align-middle">{{ $role->company->Company ?? '' }}</td>
							<td class="v-align-middle">{{ $role->description }}</td>
							<td class="v-align-middle">
								<a href="{{ action('RoleController@edit', $role->id) }}" class="btn btn-inverse">Edit</a> {{-- &nbsp;
								{{ Form::open(['action' => ['RoleController@destroy', $role->id], 'method' => 'delete', 'class' => 'inline-block']) }}
								{{ Form::submit('Delete',['class' => 'btn btn-danger ']) }}
								{{ Form::close() }} --}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection
