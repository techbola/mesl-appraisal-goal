@extends('layouts.master')

@section('content')
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
@endsection
