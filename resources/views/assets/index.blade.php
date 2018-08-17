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
    <div class="card-title pull-left">Company Assets</div>
		<div class="pull-right">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
		</div>
		<div class="clearfix"></div>

		<span class="btn btn-inverse" onclick="window.print()"><i class="fa fa-qrcode m-r-5"></i> Print tags</span>

		<form id="print_form" class="" action="" method="post">
			{{ csrf_field() }}
			<button type="submit">Print</button>
			<table id="assets" class="table table-striped table-bordered tableWithSearch">
				<thead>
					<th></th>
					<th width="20%">Description</th>
					<th>Category</th>
					<th>Location</th>
					<th>Qty</th>
					<th>Unit Cost</th>
					<th>Total</th>
					<th>Purchased On</th>
					<th>Serial No.</th>
					<th>Asset No.</th>
					<th>Allotee.</th>
					<th width="7%">Actions</th>
				</thead>
				<tfoot class="thead">
					<th></th>
					<th width="20%">Description</th>
					<th>Category</th>
					<th>Location</th>
					<th>Qty</th>
					<th>Unit Cost</th>
					<th>Total</th>
					<th>Purchased On</th>
					<th>Serial No.</th>
					<th>Asset No.</th>
					<th>Allotee.</th>
					<th width="7%">Actions</th>
				</tfoot>
				<tbody>
					@foreach ($assets as $asset)
						<tr>
							<td>
								<input type="checkbox" name="assets[]" value="{{ $asset->AssetRef }}">
							</td>
							<td>{{ $asset->Description ?? '—' }}</td>
							<td>{{ $asset->category->AssetCategory ?? '-' }}</td>
							<td>{{ $asset->location->Location ?? '-' }}</td>
							<td>{{ $asset->Quantity ?? '—' }}</td>
							<td>{{ number_format($asset->UnitCost, 2)}}</td>
							<td>{{ number_format($asset->TotalCost, 2) }}</td>
							<td>{{ ($asset->PurchaseDate)? $asset->PurchaseDate->format('jS M, Y') : '—' }}</td>
							<td>{{ $asset->SerialNo ?? '-' }}</td>
							<td>{{ $asset->AssetNo ?? '-' }}</td>
							<td>{{ $asset->allotee->FullName ?? '—' }}</td>
							<td class="actions">
								<a href="#" data-toggle="modal" data-target="#edit_asset" class="" @click="edit_asset({{ $asset }})">
									<i class="fa fa-pencil text-warning"></i>
								</a>
								<a href="#" class="" onclick="confirm2('Delete this asset?', '', 'delete_{{ $asset->AssetRef }}')">
									<i class="fa fa-trash-o text-danger"></i>
								</a>
								<form id="delete_{{ $asset->AssetRef }}" class="hidden" action="{{ route('delete_asset', $asset->AssetRef) }}" method="post">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
								</form>

								<!-- Asset maintenance -->
								<a href="#" class="" title="Asset Maintenance" onclick="">
									<i class="fa fa-wrench text-danger"></i>
								</a>
								<!-- end asset maintenance actions-->

								{{-- <a href="#" data-toggle="modal" data-target="#view_asset" class="text-primary f16 m-l-10" @click="get_contact({{ $asset }})"><i class="fa fa-eye"></i></a> --}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</form>


  </div>

    @include('assets.modals')

		{{-- Tags --}}
		<div class="print-assets print-hidden" id="print-content">
			{{-- @foreach ($assets as $asset)
				<div class="tag-list">
					<li>
						<div class="table-cell p-r-10">{{ QRCode::text('Asset name: '.strtoupper($asset->Description).' // Purchase Date: '.$asset->PurchaseDate->format('jS M, Y'))->svg() }}</div>
						<div class="table-cell" style="vertical-align:middle">
							<div class="f15 bold">{{ $asset->Description }}</div>
							<div class="f22 m-t-10">{{ $asset->AssetNo ?? '—' }}</div>
							<div class="f15 m-t-10">Serial: {{ $asset->SerialNo ?? '—' }}</div>
						</div>
					</li>
				</div>
			@endforeach --}}
		</div>
		{{-- End Tags --}}
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
					// $('#edit_asset select[name="CategoryID"] option[value="'+ asset.CategoryID +'"]').attr('selected', 'selected')
					$('#edit_asset select[name="CategoryID"]').val(asset.CategoryID).trigger('change');
					$('#edit_asset select[name="LocationID"]').val(asset.LocationID).trigger('change');
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

	<script>
    $('.exportOptions').append('<span class="btn btn-warning btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush

@push('scripts')
	<script>
		$('#print_form').on('submit', function(e){
			e.preventDefault();
			var form_data = $("#print_form > input, #print_form input[type=checkbox]").serialize();
			// console.log(form_data);
			$.post('/get_assets_print', form_data, function(data, status){
				console.log(data);
				$('.print-assets').empty();
				$.each(data, function(index, asset){
					$('.print-assets').append(`
						<div class="tag-list">
							<li>
								<div class="table-cell p-r-10">`+asset.qrcode+`</div>
								<div class="table-cell" style="vertical-align:middle">
									<div class="f15 bold">${asset.Description}</div>
									<div class="f22 m-t-10">${asset.AssetNo ? asset.AssetNo : '—'}</div>
									<div class="f15 m-t-10">Serial: ${asset.SerialNo ? asset.SerialNo : '—'}</div>
								</div>
							</li>
						</div>
					`);
				});
				window.print();
			});
		})
	</script>
	<script>
		var table = $('#assets').DataTable();
		// var tfoot = $('#assets thead tr').clone().prop('id', 'tfoot');
		// $('#assets thead').after('<tfoot></tfoot>');
		// $('#assets tfoot').append(tfoot);
		$('#assets tfoot th').each(function(key, val) {
					var title = $(this).text();
					if (key === $('#assets tfoot th')) {
							return false
					}
					$(this).html('<input type="text" class="my-input input-sm" placeholder="' + $.trim(title) + '" />');
			});
		 table.columns().every(function() {
			var that = this;
			$('input', this.footer()).on('keyup change', function() {
					if (that.search() !== this.value) {
							that.search(this.value).draw();
					}
			});
		});
		$('#assets tfoot tr').appendTo('#assets thead');
	</script>
@endpush
