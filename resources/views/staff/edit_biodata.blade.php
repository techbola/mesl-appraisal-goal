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

{{-- Modal --}}
<div class="modal fade" id="hmo_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add HMO Plan</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<hr>
		<div class="modal-body">
			<form action="" method="POST" id="hmo-plan-form">
				{{ csrf_field() }}
				@include('setup.hmoplan.form')
			</form>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="bank_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add More Banks</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<hr>
		<div class="modal-body">
			<form action="" method="POST" id="bank-form">
				{{ csrf_field() }}
				@include('setup.bank.form')
			</form>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="pfa_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add More PFAs</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<hr>
		<div class="modal-body">
			<form action="" method="POST" id="pfa-form">
				{{ csrf_field() }}
				@include('setup.pfa.form')
			</form>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="department_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<hr>
			<div class="modal-body">
				<form action="" method="POST" id="department-form">
					{{ csrf_field() }}
					@include('setup.department.form')
				</form>
			</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
	<script>
		$('.add-department').click(function(e){
          e.preventDefault();
          $('#department_setup').show();
          $('#department_setup').modal('show');

        });

        var form1 = $("#department-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/api/add_department', {
              Department: $('#Department').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#DepartmentID').append('<option selected value="'+ data.data.DepartmentRef +'">' +  data.data.Department +'</option>');
                $('#department_setup').modal('hide');
                    swal(
                        'Success',
                        data.data.Department + ' was added to the list',
                        'success'
                    )
                 $('#Department').val('');

              } else {
                    swal(
                        'error',
                        data.data.Department + ' has already been taken.',
                        'error'
                    )
                }
            });
          });


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

              } else {
								swal(
									'error',
									data.data.HMO + ' has already been taken.',
									'error'
								)
							}
            });
          });

			//HMO Plan
			$('.add-hmo-plan').click(function(e){
          e.preventDefault();
          $('#hmo_plan').show();
          $('#hmo_plan').modal('show');

        });

        var form1 = $("#hmo-plan-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/api/add_hmo_plan', {
              HMOPlan: $('#HMOPlan').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#HMOPlanID').append('<option selected value="'+ data.data.HMOPlanRef +'">' +  data.data.HMOPlan +'</option>');
                $('#hmo_plan').modal('hide');
								swal(
									'Success',
									data.data.HMOPlan + ' was added to the HMOPlan list',
									'success'
								)
                 $('#HMOPlan').val('');

              } else {
								swal(
									'error',
									data.data.HMOPlan + ' has already been taken.',
									'error'
								)
							}
            });
          });

		//Bank Setup
		$('.add-bank').click(function(e){
          e.preventDefault();
          $('#bank_id').show();
          $('#bank_id').modal('show');

        });

        var form1 = $("#bank-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/api/add_bank', {
              BankName: $('#BankName').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#BankID').append('<option selected value="'+ data.data.BankRef +'">' +  data.data.BankName +'</option>');
                $('#bank_id').modal('hide');
								swal(
									'Success',
									data.data.BankName + ' was added to the Banks list',
									'success'
								)
                 $('#BankName').val('');

              } else {
								swal(
									'error',
									data.data.BankName + ' has already been taken.',
									'error'
								)
							}
            });
          });

	//PFA Setup
	$('.add-pfa').click(function(e){
          e.preventDefault();
          $('#pfa_id').show();
          $('#pfa_id').modal('show');

        });

        var form1 = $("#pfa-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/api/add_pfa', {
              PFA: $('#PFA').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#PFAID').append('<option selected value="'+ data.data.PFARef +'">' +  data.data.PFA +'</option>');
                $('#pfa_id').modal('hide');
								swal(
									'Success',
									data.data.PFA + ' was added to the PFA list',
									'success'
								)
                 $('#PFA').val('');

              } else {
								swal(
									'error',
									data.data.PFA + ' has already been taken.',
									'error'
								)
							}
            });
          });
	</script>
@endpush
