@extends('layouts.master')

@section('title')
	Documents Management
@endsection

@section('page-title')
	Documents Management
@endsection

@section('content')
  <div class="container-fluid container-fixed-lg">
  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title">Document Listing</div>
  			<div class="pull-right">
  				<div class="col-xs-12">
  					<input type="text" class="search-table form-control pull-right" placeholder="Search">
  				</div>
  			</div>
  			<div class="clearfix"></div>
  			<table class="table tableWithSearch table-bordered">
  				<thead>
  					<th width="20%">Document Name</th>
  					<th width="15%">Type</th>
  					<th width="20%">Upload Date</th>
  					<th width="10%">Initiator</th>
  					<th width="15%">Download</th>
  					<th width="20%">Actions</th>

  				</thead>
  				<tbody>
  					@foreach ($docs as $doc)
  						<tr>
  							<td><b>{{ $doc->DocName }}</b></td>
  							<td>{{ $doc->doctype->DocType }}</td>
  							<td>{{ date('jS M, Y - g:ia', strtotime($doc->UploadDate)) }}</td>
  							<td>{{ $doc->initiator->name ?? '-' }}</td>
  							{{-- <td><a href="#" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
  							{{-- <td><a href="{{ $doctype->Path}}" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
  							<td><a href="{{ route('docs', ['file'=>$doc->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $doc->Filename}}<i class="fa fa-download m-l-5"></i></a></td>
  							<td class="actions">
  								<a href="{{ route('docmgts.details', ['id'=>$doc->DocRef]) }}" class="btn btn-sm btn-warning m-r-5" data-toggle="tooltip" title="Document details"><i class="fa fa-eye text-black"></i></a>
  								@if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('staff'))
  									<a href="{{ route('docmgts.show',[$doc->DocRef]) }}" class="btn btn-sm btn-complete">Assign</a>
  								@endif
  							</td>
  						</tr>
  					@endforeach
  				</tbody>
  			</table>

  	</div>
  	<!-- END PANEL -->
  </div>
@endsection
