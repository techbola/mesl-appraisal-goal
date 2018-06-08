@extends('layouts.master')

@push('styles')

@endpush

@section('title')
  Client Bill list
@endsection

@section('page-title')
  Client Bill list
@endsection

@section('buttons')
  <a href="{{ route('Add_Client_Document', [$client_details->ClientRef]) }}" class="btn btn-info btn-rounded pull-right" >Add New Document</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Bill List for <span style="color: #2a9df5">{{ $client_details->Name }}</span></div><div class="clearfix"></div>
        <div class="row">
          <table class="table tabel-hover table-striped">
            <thead>
              <tr>
                <th></th>
                    <th>Billing Date</th>
                    <th>Document Type</th>
                    <th>Initator</th>
                    <th>View Document</th>
                    <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($client_documents as $client_document)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $client_document->UploadDate }}</td>
                <td>{{ $client_document->DocType }}</td>
                <td>{{ $client_document->Initiator }}</td>
                <td><a href="{{ asset( 'storage/ClientDocument/'.$client_document->Filename)}}" class="btn btn-sm btn-info">View Document</a></td>
                <td>
                  <a href="#" data-id="{{ $client_document->DocRef }}"  data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-sm btn-danger"> Delete Document</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
 
@endpush


