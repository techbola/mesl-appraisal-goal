@extends('layouts.master')

@section('title')
	Company Assets
@endsection

{{-- @section('page-title')
	Company Assets
@endsection --}}

@section('buttons')
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_asset">New Asset</button>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Company Assets</div>
    <table class="table table-striped table-bordered tableWithSearch">
      <thead>
        <th width="20%">Description</th>
				<th>Category</th>
        <th>Quantity</th>
        <th>Unit Cost</th>
        <th>Total</th>
        <th>Purchased On</th>
				<th>Serial No.</th>
				<th>Asset No.</th>
        <th width="15%">Actions</th>
      </thead>
      <tbody>
				@foreach ($assets as $asset)
					<tr>
						<td>{{ $asset->Description }} / {{ $asset->location->Location }}</td>
						<td>{{ $asset->category->AssetCategory }}</td>
						<td>{{ $asset->Quantity }}</td>
						<td>{{ number_format($asset->UnitCost, 2)}}</td>
						<td>{{ number_format($asset->TotalCost, 2) }}</td>
						<td>{{ $asset->PurchaseDate->format('jS M, Y') }}</td>
						<td>{{ $asset->SerialNo }}</td>
						<td>{{ $asset->AssetNo }}</td>
						<td>
							<a href="#" data-toggle="modal" data-target="#edit_asset" class="btn btn-xs btn-inverse" @click="edit_asset({{ $asset }})">Edit</a>
							<a href="#" class="btn btn-xs btn-danger" onclick="confirm2('Delete this asset?', '', 'delete_{{ $asset->AssetRef }}')">Delete</a>
							<form id="delete_{{ $asset->AssetRef }}" class="hidden" action="{{ route('delete_asset', $asset->AssetRef) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
							</form>
							{{-- <a href="#" data-toggle="modal" data-target="#view_asset" class="text-primary f16 m-l-10" @click="get_contact({{ $asset }})"><i class="fa fa-eye"></i></a> --}}
						</td>
					</tr>
				@endforeach
      </tbody>
    </table>
  </div>

    @include('assets.modals')
@endsection

@push('vue')
	<script>
		var base = "{{ url('/') }}";
		new Vue({
			el: '#app',
			data: {
				asset: {},
			},
			methods: {
				edit_asset(asset) {
					this.asset = asset;
					$('#asset_form_edit').attr('action', base + '/update-asset/' + asset.AssetRef);
				},
			},
		});
	</script>

	<script>
	// Asset Categories
	function new_cat() {
    $('.select_cat').removeAttr('name').hide();
    $('.input_cat').prop('name', 'Category').show();
    $('.toggle_cat').html('<i class="fa fa-times-circle text-danger"></i>').attr('onclick', 'choose_cat()');
  }
  function choose_cat() {
    $('select.select_cat').attr('name', 'CategoryID');
    $('.select2-container.select_cat').show();
    $('.input_cat').removeAttr('name').hide();
    $('.toggle_cat').html('<i class="fa fa-plus-circle text-success"></i>').attr('onclick', 'new_cat()');
  }
	// Asset Location
	function new_loc() {
    $('.select_loc').removeAttr('name').hide();
    $('.input_loc').prop('name', 'Location').show();
    $('.toggle_loc').html('<i class="fa fa-times-circle text-danger"></i>').attr('onclick', 'choose_loc()');
  }
  function choose_loc() {
    $('select.select_loc').attr('name', 'LocationID');
    $('.select2-container.select_loc').show();
    $('.input_loc').removeAttr('name').hide();
    $('.toggle_loc').html('<i class="fa fa-plus-circle text-success"></i>').attr('onclick', 'new_loc()');
  }
	</script>
@endpush
