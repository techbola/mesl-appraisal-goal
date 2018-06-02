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
				{{ Form::model($menu,['action' => [ 'MenuController@update', $menu->id ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form', 'method' => 'patch']) }}
					@include('menus.form', ['buttonText' => 'Update Menu' ])
				{{ Form::close() }}
			</div>
		</div>
@endsection
