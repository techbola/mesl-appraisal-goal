@extends('layouts.master')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- START PANEL -->
			<div class="card-box">
				<div class="card-title pull-left">
					Menus Listing
				</div>
				<div class="pull-right">
					<div class="col-xs-12">
						<input type="text" class="search-table form-control pull-right" placeholder="Search">
					</div>
				</div>
				<div class="clearfix"></div>



				<table class="table tableWithSearch table-striped table-bordered">
					<thead>
						<tr>
							<th>Menu</th>
							{{-- <th>Route</th> --}}
							<th width="40%">Roles</th>
							{{-- <th>Description</th> --}}
							<th width="20%">Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($menus->where('parent_id', 0) as $menu)
							{{-- Parents --}}
							<tr>
								<td><b class="text-primary text-uppercase">{{ $menu->name }}</b></td>
								{{-- <td>{{ $menu->route }}</td> --}}
								<td>{{ $menu->company_role_names }}</td>
								{{-- <td>{{ $menu->description ?? '—' }}</td> --}}
								<td class="actions">
									<a href="{{ route('edit_company_menu', $menu->id) }}" class="btn btn-info btn-sm m-r-5">Edit</a>

								</td>
							</tr>
							{{-- Children --}}
							@foreach ($menu->children as $child)
								<tr>
									<td><i class="pg pg-minus m-r-10" data-toggle="tooltip" title="Sub-menu"></i>{{ $child->name }}</td>
									{{-- <td>{{ $child->route }}</td> --}}
									<td>{{ $child->company_role_names }}</td>
									{{-- <td>{{ $child->description ?? '—' }}</td> --}}
									<td class="actions">
										<a href="{{ route('edit_company_menu', $child->id) }}" class="btn btn-info btn-sm m-r-5">Edit</a>

									</td>
								</tr>
							@endforeach

						@endforeach
					</tbody>

				</table>

			</div>
			<!-- END PANEL -->
		</div>
	</div>

@endsection
