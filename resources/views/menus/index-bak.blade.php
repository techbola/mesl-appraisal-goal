@extends('layouts.header')

@section('title')
	Manage Menus
@endsection

@section('content')

	{{-- <div class="c-card u-p-medium u-mb-medium">

		<div class="c-card__header c-card__header--transparent o-line">
        <h5 class="c-card__title">Manage Menus</h5>
        <div class="c-card__meta">
            <a href="#">View All</a>
        </div>
    </div>

		<div class="clearfix">
			<h5 class="m-b-20 pull-left">Manage Menus</h5>
			<a class="c-btn c-btn--success pull-right" data-toggle="modal" data-target="#menu-modal">
          <i class="fa fa-plus u-mr-xsmall u-opacity-medium"></i>New Menu
      </a>
		</div>

	</div> --}}


		<!-- START PANEL -->
		{{-- <div class="panel panel-transparent">
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
		</div> --}}

{{-- <div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Menus Listing
			</div>
			<div class="pull-right">
				<div class="col-xs-12">
					<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
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
		</div>
	</div>
	<!-- END PANEL -->
</div> --}}


<div class="c-table-responsive@desktop">
	<table class="c-table" id="datatable">
      <caption class="c-table__title">
          {{-- Sortable Tables <small>Powered by DataTables</small> --}}
					<div class="clearfix">
						<span class="pull-left">Manage Menus</span>
						<a class="c-btn c-btn--success pull-right" data-toggle="modal" data-target="#menu-modal">
			          <i class="fa fa-plus u-mr-xsmall u-opacity-medium"></i>New Menu
			      </a>
					</div>

      </caption>

      <thead class="c-table__head c-table__head--slim">
          <tr class="c-table__row">
              <th class="c-table__cell c-table__cell--head">Menu</th>
              <th class="c-table__cell c-table__cell--head">Route</th>
              <th class="c-table__cell c-table__cell--head" width="20%">Roles</th>
              <th class="c-table__cell c-table__cell--head">Description</th>
              <th class="c-table__cell c-table__cell--head" width="30%">Action</th>
          </tr>
      </thead>

      <tbody>
          {{-- <tr class="c-table__row">
              <td class="c-table__cell">New Dashboard</td>
              <td class="c-table__cell">17th Oct, 17</td>
              <td class="c-table__cell">Mahmoud</td>
              <td class="c-table__cell">$4,670</td>
              <td class="c-table__cell">Finishing</td>
          </tr> --}}
					@foreach ($menus->where('parent_id', 0) as $menu)
						{{-- Parents --}}
						<tr class="c-table__row">
							<td class="c-table__cell"><b class="text-primary text-uppercase">{{ $menu->name }}</b></td>
							<td class="c-table__cell">{{ $menu->route }}</td>
							<td class="c-table__cell">{{ $menu->role_names }}</td>
							<td class="c-table__cell">{{ $menu->description ?? '—' }}</td>
							<td class="c-table__cell actions">
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
							<tr class="c-table__row">
								<td class="c-table__cell"><i class="pg pg-minus m-r-10" data-toggle="tooltip" title="Sub-menu"></i>{{ $child->name }}</td>
								<td class="c-table__cell">{{ $child->route }}</td>
								<td class="c-table__cell">{{ $child->role_names }}</td>
								<td class="c-table__cell">{{ $child->description ?? '—' }}</td>
								<td class="c-table__cell actions">
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


{{-- MODALS --}}

<!-- New Menu -->
<div class="c-modal c-modal--large modal fade" id="menu-modal" tabindex="-1" role="dialog" aria-labelledby="standard-modal" data-backdrop="static">
		<div class="c-modal__dialog modal-dialog" role="document">
				<div class="c-modal__content">

						<div class="c-modal__header">
								<h3 class="c-modal__title">Create New Menu</h3>

								<span class="c-modal__close" data-dismiss="modal" aria-label="Close">
										<i class="fa fa-close"></i>
								</span>
						</div>
						{{-- <div class="c-modal__subheader">
								<p>This is the sub header title</p>
						</div> --}}
						<div class="c-modal__body">
								{{ Form::open(['action' => 'MenuController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
									@include('menus.form', ['buttonText' => 'Create Menu' ])
								{{ Form::close() }}
						</div>

						{{-- <div class="c-modal__footer">
								<p>This is the modal footer</p>
						</div> --}}

				</div><!-- // .c-modal__content -->
		</div><!-- // .c-modal__dialog -->
</div><!-- // .c-modal -->
@endsection
