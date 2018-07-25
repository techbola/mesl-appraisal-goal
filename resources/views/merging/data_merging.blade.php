@extends('layouts.master')

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Data Merging
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6" id="actual">
					<div style="padding: 10px; background: #eee">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Action</th>
									<th>Block Number</th>
									<th>Flat Number</th>
									<th>House Name</th>
								</tr>
							</thead>
							<tbody>
								@foreach($address1s as $address1)
								<tr>
									<td><input type="checkbox" class="f1" name="ref[]" value="{{$address1->Ref}}"></td>
									<td>{{ $address1->BlockNumber }}</td>
									<td>{{ $address1->FlatNumber }}</td>
									<td>{{ $address1->HouseName }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
                
				<div class="col-md-6" id="update">
					<div style="padding: 10px; background: #eee">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Action</th>
									<th>Estate</th>
									<th>Block Number</th>
									<th>Flat Number</th>
									<th>House Name</th>
								</tr>
							</thead>
							<tbody>
								@foreach($address2s as $address2)
								<tr>
									<td><input type="checkbox" value="{{ $address2->Ref }}"></td>
									<td>{{ $address2->EstateCode }}</td>
									<td>{{ $address2->BlockNumber }}</td>
									<td>{{ $address2->FlatNumber }}</td>
									<td>{{ $address2->HouseName }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{ Form::open(['action' => 'MergingController@store', 'autocomplete' => 'off', 'role' => 'form']) }}
						   <input type="hidden" id="address1_ref" name="address1">
						   <input type="hidden" id="address2_ref" name="address2">
						<input type="submit" class="btn btn-sm btn-primary pull-right" value="Merge Data">
					</div>
				</div>
		{{ Form::close() }}
			</div><br><br>

			<div class="row">
				<table class="table table-hover">
					<thead>
						<th>Action</th>
						<th>Estate</th>
						<th>Block Number</th>
						<th>Flat Number</th>
						<th>House Name</th>
					</thead>
					<tbody>
						@foreach($merged as $meg)
								<tr>
									<td>{{ $loop->index + 1 }}</td>
									<td>{{ $meg->EstateCode }}</td>
									<td>{{ $meg->BlockNumber }}</td>
									<td>{{ $meg->FlatNumber }}</td>
									<td>{{ $meg->Housename }}</td>
								</tr>
								@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection

@push('scripts')
	<script>
		$('#actual input[type=checkbox]').change(function(){
			$('#address1_ref').val('');
          if($(this).is(':checked')){ 
             $('#actual').find('input[type=checkbox]').attr('disabled','');
               $(this).attr('disabled',false);
               var data1 = $(this).val();
               $('#address1_ref').val(data1);
              }else{
                $('#actual').find('input[type=checkbox]').attr('disabled',false);
             }
          });
	</script>

	<script>
		$('#update input[type=checkbox]').change(function(){
			$('#address2_ref').val('');
          if($(this).is(':checked')){ 
             $('#update').find('input[type=checkbox]').attr('disabled','');
               $(this).attr('disabled',false);
              var data2 = $(this).val();
              $('#address2_ref').val(data2);
              }else{
                $('#update').find('input[type=checkbox]').attr('disabled',false);
             }
          });
	</script>
@endpush
