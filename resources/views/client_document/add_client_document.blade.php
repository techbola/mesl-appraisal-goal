@extends('layouts.master')
@section('title')
  Client Document list
@endsection

@section('page-title')
  Client Document list
@endsection

@section('buttons')
  
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box" style="padding: 80px">
  			<div class="card-title pull-left">Document List for <span style="color: #2a9df5">{{ $client_details->Name }}</span></div><div class="clearfix"></div>
           <div class="row">
              {{ Form::open(['action' => 'ClientDocumentController@store_client_document', 'autocomplete' => 'off', 'role' => 'form', 'files'=> true]) }}
                    @include('client_document.form', ['buttonText' => 'Uplod Document'])
               {{ Form::close() }}
           </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
@endpush


