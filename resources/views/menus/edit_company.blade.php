@extends('layouts.master')
@section('content')
		<!-- START PANEL -->
		<div class="panel panel-default">
		<div class="panel-heading">
		<div class="panel-title">
			Update Menu
		</div>
	</div>
			<div class="panel-body">
				{{ Form::model($menu,['action' => [ 'MenuController@update_company_menu', $menu->id ], 'autocomplete' => 'off', 'role' => 'form', 'method' => 'patch']) }}

					<div class="row">
						<div class="col-md-6">
							<div class="form-group select2">
									{{ Form::label('roles', 'Select Roles') }}
									{{ Form::select('roles[]', $roles->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => " Select Roles", 'data-init-plugin' => "select2", "multiple"]) }}
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="pull-right">
						{{ Form::submit('Save', ['class' => 'btn btn-complete']) }}
					</div>


				{{ Form::close() }}
			</div>
		</div>
@endsection
