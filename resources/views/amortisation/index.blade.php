@extends('layouts.master')

@section('title')
	Amortisation
@endsection

{{-- @section('page-title')
	Company Assets
@endsection --}}

@section('buttons')
		{{-- <button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_asset">New Asset</button> --}}
		<button class="btn btn-info btn-rounded btn-sm" data-toggle="modal" data-target="#new_amort">New Amortisation</button>
@endsection

@section('content')
	<style>
		.toggle_icon {
		  font-size: 20px;
		}
	</style>

	<div id="vue">


		<div class="card-box">
			<div class="card-title pull-left">Amortisation</div>
			<div class="pull-right">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
			<div class="clearfix"></div>
			<table class="table table-striped table-bordered tableWithSearch">
				<thead>
					<th width="20%">Monthly Amort Item</th>
					<th>Amount</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>GL Debit</th>
					<th>GL Credit</th>
					<th width="15%">Actions</th>
				</thead>
				<tbody>
					@foreach ($amorts as $amort)
						<tr>
							<td>{{ $amort->item->MonthlyAmortItem ?? '-' }}</td>
							<td>{{ $amort->Amount ?? '-' }}</td>
							<td>{{ $amort->StartDate ?? '-' }}</td>
							<td>{{ $amort->EndDate ?? '-' }}</td>
							<td>{{ $amort->gldebit->Description ?? '-' }}</td>
							<td>{{ $amort->glcredit->Description ?? '-' }}</td>

							<td>
								{{-- <a href="#" data-toggle="modal" data-target="#edit_amort" class="btn btn-xs btn-inverse" @click="edit_amort({{ $amort }})">Edit</a> --}}
								<a href="{{ route('edit_amort', $amort->MonthlyAmortRef) }}" class="btn btn-xs btn-info m-r-5">Edit</a>
								<a href="#" class="btn btn-xs btn-danger" onclick="$('#delete_{{ $amort->MonthlyAmortRef }}').submit();">Delete</a>
								<form id="delete_{{ $amort->MonthlyAmortRef }}" class="hidden" action="{{-- route('delete_amort', $amort->MonthlyAmortRef) --}}" method="post" onsubmit="return confirm('Delete this amort?');">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
								</form>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>

	    @include('amortisation.modals')

	</div>

@endsection

@push('vue')
	<script>
		var base = "{{ url('/') }}";
		new Vue({
			el: '#vue',
			data: {
				amort: {},
			},
			methods: {
				edit_amort(amort) {
					this.amort = amort;
					$('#amort_form_edit').attr('action', base + '/update-amort/' + amort.MonthlyAmortRef);
					// $('#edit_asset select[name="CategoryID"] option[value="'+ asset.CategoryID +'"]').attr('selected', 'selected')
					$('#edit_amort select[name="MonthlyAmortItemID"]').val(amort.MonthlyAmortItemID).trigger('change');
				},
			},
		});
	</script>

	<script>
	// Asset Categories
	function new_item() {
    $('.select_item').removeAttr('name').hide();
    $('.input_item').prop('name', 'MonthlyAmortItem').show();
    $('.toggle_item').html('<i class="fa fa-times-circle text-danger"></i>').attr('onclick', 'choose_item()');
  }
  function choose_item() {
    $('select.select_item').attr('name', 'MonthlyAmortItemID');
    $('.select2-container.select_item').show();
    $('.input_item').removeAttr('name').hide();
    $('.toggle_item').html('<i class="fa fa-plus-circle text-success"></i>').attr('onclick', 'new_item()');
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
