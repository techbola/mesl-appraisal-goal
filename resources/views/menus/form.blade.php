@include('errors.list')
<div class="row clearfix">
						<div class="col-sm-6">
							<div class="form-group required">
								{{ Form::label('name','Menu Name') }}
								{{ Form::text('name', null,  ['class' => 'form-control', 'placeholder' => 'Enter menu name e.g Setup']) }}
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								{{ Form::label('route','Route Name') }}
								{{-- {{ Form::text('route', null,  ['class' => 'form-control', 'placeholder' => 'Enter route url e.g menu.create']) }} --}}
								<select name="route" class="full-width" data-init-plugin="select2" data-placeholder="Select Menu">
								<option value="#" >No Route</option>
								@foreach ($routes as $key => $value)
								@if (isset($menu))
								 <option value="{{ $value }}"  @if ($menu->route == $value) selected @endif>{{ $value }}</option>
								@else
								<option value="{{ $value }}">{{ $value }}</option>
								@endif
								@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group required">
								<label>Menu Group</label>
								<span class="help">"Choose Parent Menu if menu is a parent menu"</span>
								{{ Form::select('parent_id', [ 0 =>  'Parent Menu'] + $menus->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select menu", 'data-init-plugin' => "select2"]) }}
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Description</label>
								{{ Form::text('description', null, ['class'=>"form-control", 'placeholder'=>"Short description about the menu function"] ) }}
							</div>
						</div>
					</div>

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
						{{ Form::submit($buttonText, ['class' => 'btn btn-complete']) }}
					</div>
