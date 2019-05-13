@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<!-- START PANEL -->
			<div class="card-box">
				<div class="card-title">
					Create Menus
				</div>
				{{ Form::open(['action' => 'MenuController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
					@include('menus.form', ['buttonText' => 'Create Menu' ])
				{{ Form::close() }}
			</div>
			{{-- End Panel --}}
		</div>
	</div>



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



				<table id="menus" class="table table-striped table-bordered">
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
										<a onclick="confirm2('Delete {{ $child->name }}?', '', 'delete_menu_{{ $child->id }}')" class="btn btn-danger btn-sm">Delete</a>
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
			<!-- END PANEL -->
		</div>
	</div>

@endsection

@push('scripts')

<script>
	var settings = {
    // "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
    sDom: 'lfrB<"pull-right">tip',
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
     // "columnDefs": [
     //        {
     //            "targets": [ 3 ],
     //            "visible": false
     //        }
     //    ],
    "iDisplayLength": 20,
     buttons: [
            'copy', 'excel', 'pdf', 'print', {
                extend: 'colvis',
                columns: ':gt(0)',
                text: 'Columns'
            }
        ],
    fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions'));
    }
};


var table = $('#menus').DataTable(settings);
 $('#menus tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
</script>

@endpush
