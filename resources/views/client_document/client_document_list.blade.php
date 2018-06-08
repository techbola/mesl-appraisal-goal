@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush

@section('title')
  Client Document list
@endsection

@section('page-title')
  Client Document list
@endsection

@section('buttons')
  <a href="{{ route('Add_Client_Document', [$client_details->ClientRef]) }}" class="btn btn-info btn-rounded pull-right" >Add New Document</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Document List for <span style="color: #2a9df5">{{ $client_details->Name }}</span></div><div class="clearfix"></div>
        <div class="row">
          <table class="table tabel-hover table-striped">
            <thead>
              <tr>
                <th></th>
                    <th>Uploaded Date</th>
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
                  <a href="#" data-id="{{ $client_document->DocRef }}" data-ref="{{ $client_details->ClientRef }}"  data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-sm btn-danger"> Delete Document</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  	</div>
  	<!-- END PANEL -->

    <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000">Client Document Deletion Notification</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-9" style="color: #000">
                     Thsi document will be deleted <span style="font-weight: 800" id="pat_name"></span> on Click of the button 
                    </div>
                    <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                      {{ Form::open(['action' => 'ClientDocumentController@delete_client_document', 'autocomplete' => 'off', 'role' => 'form']) }}
                            <input type="hidden" name="doc_id" id="getValue">
                            <input type="hidden" name="client_id" id="getRef">
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete Document">
                      {{ Form::close() }}
                      {{-- <a href="{{ route('NotificationBilling',[$customerDetails->PatientRef]) }}" class="btn btn-primary btn-lg btn-large fs-15" title="">Create Bill</a> --}}
                    </div>
                  </div>
                  <p class="text-right sm-text-center hinted-text p-t-10 p-r-10" style="color: red">Please be sure of the document you want to delete.</p>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

@endsection

@push('scripts')
    <script>
    $(document).on("click", "#btnFillSizeToggler2", function() {
            var id = $(this).data('id');
            $("#modalFillIn #getValue").val(id);

             var ref = $(this).data('ref');
            $("#modalFillIn #getRef").val(ref);

          });
  </script>

@endpush


