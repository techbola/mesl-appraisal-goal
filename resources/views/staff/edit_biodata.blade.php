@extends('layouts.master')

@section('content')

<style>
	.form-add-more{
      width: 20px;
      height: 20px;
      line-height: 20px;
      border-radius: 50%;
      text-align: center;
      padding: 0 !important;
      cursor: pointer;
	}
</style>

<div class="card-box">
	<div class="card-title">Edit Bio Data - <b class="text-primary">{{ $staff->FullName }}</b></div>
	{{ Form::model($staff, ['route' => ['updatebiodata', $staff->StaffRef ],'files' => true, 'autocomplete' => 'off', 'role' => 'form']) }}
	{{ method_field('PATCH') }}
	{{-- @if ($user->hasRole('admin')) --}}
		@include('Staff.biodataform', ['buttonText' => 'Update Bio Data'])
	{{-- @else
		@include('Staff.biodataform', ['buttonText' => 'Update Bio Data'])
	@endif --}}
	{{ Form::close() }}
</div>

{{-- Modal --}}
<div class="modal fade" id="hmo_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add HMO</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<hr>
		<div class="modal-body">
			<form action="" method="POST" id="hmo-form">
				{{ csrf_field() }}
				@include('setup.hmo.form')
			</form>
		</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
	<script>
		$('.add-hmo').click(function(e){
          e.preventDefault();
          $('#hmo_id').show();
          $('#hmo_id').modal('show');
          
        });

        var form1 = $("#hmo-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/api/add_hmo', {
              HMO: $('#HMO').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#HMOID').append('<option selected value="'+ data.data.HMORef +'">' +  data.data.HMO +'</option>');
                $('#hmo_id').modal('hide');
								swal(
									'Success',
									data.data.HMO + ' was added to the HMO list',
									'success'
								)
                 $('#HMO').val('');
                 
              }
            });
          });
	</script>
@endpush
