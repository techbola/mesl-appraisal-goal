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
    <table class="table table-striped tableWithSearch">
      <thead>
        <th width="20%">Description</th>
        <th>Quantity</th>
        <th>Unit Cost</th>
        <th>Total</th>
        <th>Purchased On</th>
				<th>Serial No.</th>
				<th>Asset No.</th>
        <th width="10%">Actions</th>
      </thead>
      <tbody>
				@foreach ($assets as $asset)
					<tr>
						<td>{{ $asset->Description }}</td>
						<td>{{ $asset->Quantity }}</td>
						<td>{{ $asset->UnitCost }}</td>
						<td>{{ $asset->TotalCost }}</td>
						<td>{{ $asset->PurchaseDate }}</td>
						<td>{{ $asset->SerialNo }}</td>
						<td>{{ $asset->AssetNo }}</td>
						<td>
							<a href="{{-- route('edit_contact', $contact->CustomerRef) --}}" class="text-warning f16"><i class="fa fa-pencil"></i></a>
							<a href="javascript:void()" data-toggle="modal" data-target="#view_contact" class="text-primary f16 m-l-10" @click="get_contact({{-- $contact --}})"><i class="fa fa-eye"></i></a>
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

		new Vue({
			el: '#app',
			data: {
				asset: {},
			},
			methods: {
				get_asset(asset) {
					this.asset = asset;
				},
			},
		});
	</script>
@endpush
