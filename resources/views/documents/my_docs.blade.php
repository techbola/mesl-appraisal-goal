@extends('layouts.master')

@section('title')
	My Documents
@endsection

@section('page-title')
	My Documents
@endsection

@section('buttons')
	<button class="btn btn-info btn-rounded pull-right" data-toggle="modal" data-target="#new_doc">New Document</button>
@endsection

@section('content')

	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_doc">New Document</button>
	</div> --}}

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Document Listing</div>
  			<div class="pull-right">
  				<div class="col-xs-12">
  					<input type="text" class="search-table form-control pull-right" placeholder="Search">
  				</div>
  			</div>
  			<div class="clearfix"></div>
  			<table class="table tableWithSearch table-striped table-bordered">
  				<thead>
  					<th width="20%">Document Name</th>
  					<th width="15%">Type</th>
  					<th width="20%">Upload Date</th>
  					<th width="20%">Uploaded By</th>
  					<th width="15%">Download</th>
  					{{-- <th width="10%">Actions</th> --}}

  				</thead>
  				<tbody>
  					@foreach ($docs as $doc)
  						<tr>
  							<td><b>{{ $doc->DocName ?? '' }}</b></td>
  							<td>{{ $doc->doctype->DocType ?? '' }}</td>
  							<td>{{ date('jS M, Y - g:ia', strtotime($doc->UploadDate)) }}</td>
  							<td>{{ $doc->initiator->FullName ?? '-' }}</td>
  							{{-- <td><a href="#" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
  							{{-- <td><a href="{{ $doctype->Path}}" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
  							<td><a href="{{ route('docs', ['file'=>$doc->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $doc->Filename}}<i class="fa fa-download m-l-5"></i></a></td>
  							{{-- <td class="actions">
  								<a href="{{ route('docmgts.details', ['id'=>$doc->DocRef]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="Document details">View</a>
  								@if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('staff'))
  									<a href="{{ route('docmgts.show',[$doc->DocRef]) }}" class="btn btn-sm btn-complete">Assign</a>
  								@endif
  							</td> --}}
  						</tr>
  					@endforeach
  				</tbody>
  			</table>

  	</div>
  	<!-- END PANEL -->

		{{-- MODALS --}}
		<!-- Modal -->
		<div class="modal fade slide-up disable-scroll" id="new_doc" tabindex="-1" role="dialog" aria-hidden="false">
			<div class="modal-dialog ">
				<div class="modal-content-wrapper">
					<div class="modal-content">
						<div class="modal-header clearfix text-left">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
							</button>
							<h5>Upload New Document</h5>
						</div>
						<div class="modal-body">
							<form action="{{ route('document_store') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								@include('documents.form')
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
