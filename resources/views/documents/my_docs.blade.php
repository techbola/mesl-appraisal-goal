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
  					<th width="15%">Uploaded By</th>
  					<th width="15%">Approved By</th>
  					<th width="15%">Download</th>
  					<th width="15%">Actions</th>

  				</thead>
  				<tbody>
  					@foreach ($docs as $doc)
  						<tr>
  							<td><b>{{ $doc->DocName ?? '' }}</b></td>
  							<td>{{ $doc->doctype->DocType ?? '' }}</td>
  							<td>{{ date('jS M, Y - g:ia', strtotime($doc->UploadDate)) }}</td>
  							<td>{{ $doc->initiator->FullName ?? '-' }}</td>
  							<td>{{ ($doc->approver)? $doc->approver->FullName : '-' }}</td>
  							{{-- <td><a href="#" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
  							{{-- <td><a href="{{ $doctype->Path}}" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
  							<td><a href="{{ route('docs', ['file'=>$doc->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $doc->Filename}}<i class="fa fa-download m-l-5"></i></a></td>
  							<td class="actions">
                  @if(!$doc->sent())
	  								<a href="{{ route('send_document', ['id' => $doc->DocRef]) }}" class="btn btn-xs btn-inverse m-r-5" data-toggle="tooltip" title="Document details">Send</a>
                  @else
	                  <a href="{{ route('send_document', ['id' => $doc->DocRef]) }}" class="btn btn-xs disabled m-r-5" data-toggle="tooltip" title="Document details">Sent <i cla></i></a>
                  @endif

									@can ('edit-doc', $doc)
										<a class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_doc" onclick="edit_doc({{ $doc }}, {{ $doc->assignees->pluck('StaffRef') }})">Edit</a>
									@endcan
  							</td>
  						</tr>
  					@endforeach
  				</tbody>
  			</table>

  	</div>
  	<!-- END PANEL -->




		{{-- MODALS --}}
		<!-- Create Modal -->
		<div class="modal fade slide-up disable-scroll" id="new_doc" role="dialog" aria-hidden="false">
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

		<!-- Edit Modal -->
		<div class="modal fade slide-up disable-scroll" id="edit_doc" role="dialog" aria-hidden="false">
			<div class="modal-dialog ">
				<div class="modal-content-wrapper">
					<div class="modal-content">
						<div class="modal-header clearfix text-left">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
							</button>
							<h5>Edit Document</h5>
						</div>
						<div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								{{ method_field('PATCH') }}
								@include('documents.form_edit')
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

@push('scripts')
	<script>
		function edit_doc(doc, assignees) {
			// $.get('/get_doc/'+id, function(doc, status){
				$('#edit_doc form').attr('action', '/update_document/'+doc.DocRef);
				$('#edit_doc select[name=DocTypeID]').val(doc.DocTypeID).trigger('change');
				$('#edit_doc input[name=DocName]').val(doc.DocName);
				$('#edit_doc textarea[name=Description]').val(doc.Description);
				$('#edit_doc select[name="Staff[]"]').val(assignees).trigger('change');
			// });
		}
	</script>
@endpush
