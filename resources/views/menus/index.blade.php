@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<!-- START PANEL -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						Create Menus
					</div>
				</div>
				<div class="panel-body">
					{{ Form::open(['action' => 'MenuController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
						@include('menus.form', ['buttonText' => 'Create Menu' ])
					{{ Form::close() }}
				</div>
			</div>
			{{-- End Panel --}}
		</div>
	</div>

@endsection

@section('bottom-content')

<div class="container-fluid container-fixed-lg">

	<div class="row">
		<div class="col-md-12">
			<!-- START PANEL -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						Menus Listing
					</div>
					<div class="pull-right">
						<div class="col-xs-12">
							<input type="text" class="search-table form-control pull-right" placeholder="Search">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					<menus-list token="{{ csrf_token() }}">
						<span slot="method">
							{{ method_field('DELETE') }}
						</span>
					</menus-list>

					<table class="table tableWithSearch">
						<thead>
							<tr>
								<th>Menu</th>
								<th>Route</th>
								<th width="20%">Roles</th>
								<th>Description</th>
								<th width="30%">Actions</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($menus->where('parent_id', 0) as $menu)
								{{-- Parents --}}
								<tr>
									<td><b class="text-primary text-uppercase">{{ $menu->name }}</b></td>
									<td>{{ $menu->route }}</td>
									<td>{{ $menu->role_names }}</td>
									<td>{{ $menu->description ?? '—' }}</td>
									<td class="actions">
										<a href="{{ route('edit_menu', ['id'=>$menu->id]) }}" class="btn btn-info btn-sm m-r-5">Edit</a>

										{{-- Disable Delete Function If Parent Menu Has Children --}}
										@if (count($menu->children) > 0)
											<a onclick="warn('This menu still has sub-menus', '<span class=\'text-danger\'>Please delete the sub-menus or move them to another parent.</span>', 'animated shake')" class="btn btn-danger btn-sm">Delete</a>
										@else
											<a onclick="confirm2('Delete {{  $menu->name }}?', '', 'delete_menu_{{ $menu->id }}')" class="btn btn-danger btn-sm">Delete</a>
											<form id="delete_menu_{{ $menu->id}}" action="{{ route('delete_menu', ['id'=>$menu->id]) }}" method="post" style="display:none">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
											</form>
										@endif

									</td>
								</tr>
								{{-- Children --}}
								@foreach ($menu->children as $child)
									<tr>
										<td><i class="pg pg-minus m-r-10" data-toggle="tooltip" title="Sub-menu"></i>{{ $child->name }}</td>
										<td>{{ $child->route }}</td>
										<td>{{ $child->role_names }}</td>
										<td>{{ $child->description ?? '—' }}</td>
										<td class="actions">
											<a href="{{ route('edit_menu', ['id'=>$child->id]) }}" class="btn btn-info btn-sm m-r-5">Edit</a>
											<a onclick="confirm2('Delete {{  $child->name }}?', '', 'delete_menu_{{ $child->id }}')" class="btn btn-danger btn-sm">Delete</a>
											<form id="delete_menu_{{ $child->id}}" action="{{ route('delete_menu', ['id'=>$child->id]) }}" method="post" style="display:none">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
											</form>
										</td>
									</tr>
								@endforeach

							@endforeach
						</tbody>


					</table>
				</div>
			</div>
			<!-- END PANEL -->
		</div>
	</div>
</div>

@endsection
