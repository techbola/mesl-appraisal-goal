@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			Search For Product(s) & Service(s) 
		</div>
	</div><hr>
	<div class="panel-body">
    {{ Form::open(['action' => 'ReportController@searchoneyrpatient', 'autocomplete' => 'off', 'role' => 'form']) }}
    @include('reports.oneyrpatientform', ['buttonText' => 'Search For Bills'])
    {{ Form::close() }}
	</div>
</div>
@endsection

