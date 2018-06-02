@include('errors.list')
<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					{{ Form::label('name', 'Name', ['class' => 'req']) }}
					{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of Role', 'required']) }}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<div class="controls">
						{{ Form::label('display_name', 'Display Name') }}
						{{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Display Name']) }}
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
					{{ Form::label('description', null) }}
					{{ Form::text('description',null, ['class' => 'form-control',  'placeholder' => 'Enter description']) }}
			</div>
		</div>

		@if (auth()->user()->is_superadmin)
			<div class="col-md-6">
				<div class="form-group">
					{{ Form::label('CompanyID', null, ['class' => 'req']) }}
					{{ Form::select('CompanyID', [''=>'Select Company'] + $companies->pluck('Company', 'CompanyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Company", 'data-init-plugin' => "select2", 'required']) }}
				</div>
			</div>
		@endif

		<br>

		<div class="row">
			<div class="pull-right">
				{{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
				{{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
			</div>
		</div>
