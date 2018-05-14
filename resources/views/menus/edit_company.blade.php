@extends('layouts.master')
@section('content')
		<!-- START PANEL -->
		<div class="row">
			<div class="col-md-7">
				<div class="card-box">
					<div class="card-title">Assign Menu</div>
					<div>
						{{ Form::model($menu,['action' => [ 'MenuController@update_company_menu', $menu->id ], 'autocomplete' => 'off', 'role' => 'form', 'method' => 'patch']) }}


									<div class="form-group select2">
											{{ Form::label('roles', 'Select Roles') }}
											{{ Form::select('roles[]', $roles->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => " Select Roles", 'data-init-plugin' => "select2", "multiple"]) }}
									</div>

							<div class="clearfix"></div>
							<div class="text-right">
								{{ Form::submit('Save', ['class' => 'btn btn-info']) }}
							</div>

						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
@endsection
