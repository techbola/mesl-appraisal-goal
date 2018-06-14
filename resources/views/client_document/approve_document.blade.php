@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

tfoot{
      display: table-header-group;
     }
  </style>
@endpush

@section('title')
  Approve Documents
@endsection

@section('page-title')
  Approve Documents
@endsection

@section('buttons')

@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">List of unapproved Documents</div><div class="clearfix"></div>
        <div class="row">
          <table  class="table tableWithExportOptions" id="transactions">
            <thead>
                <th></th>
                    <th>Uploaded Date</th>
                    <th>Document Type</th>
                    <th>Initator</th>
                    <th>Description</th>
                    <th>Approve</th>
                    <th >view</th>
                    <th >Delete</th>
            </thead>
            {{-- <tfoot class="thead">
                    <th></th>
                    <th>Uploaded Date</th>
                    <th>Document Type</th>
                    <th>Initator</th>
                    <th>Description</th>
                    <th>Approve</th>
                    <th >view</th>
                    <th >Delete</th>
            </tfoot> --}}
            <tbody>
              @foreach($client_documents as $client_document)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $client_document->UploadDate }}</td>
                <td>{{ $client_document->DocType }}</td>
                <td>{{ $client_document->Initiator }}</td>
                <td>{{ $client_document->Description }}</td>
                <td><a href="#" data-id="{{ $client_document->DocRef }}"  data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-sm btn-success">Approve Document</a></td>
                <td>
                  <a href="{{ asset( 'storage/ClientDocument/'.$client_document->Filename)}}" class="btn btn-sm btn-info">View Document</a></td>
                  <td>
                  <a href="#" data-id="{{ $client_document->DocRef }}"   data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-sm btn-danger"> Delete Document</a>
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
                     This document will be deleted <span style="font-weight: 800" id="pat_name"></span> on Click of the button 
                    </div>
                    <div class="col-md-3 no-padding sm-m-t-10 sm-text-center">
                      {{ Form::open(['action' => 'ClientDocumentController@approve_post_document', 'autocomplete' => 'off', 'role' => 'form']) }}
                            <input type="hidden" name="doc_id" id="getValue">
                            <input type="submit" class="btn btn-sm btn-success" value="Approve Document">
                      {{ Form::close() }}
                    </div>
                  </div>
                  <p class="text-right sm-text-center hinted-text p-t-10 p-r-10" style="color: green">Please be sure of the document you want to delete.</p>
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

          });
  </script>

<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  // $('#transactions').editableTableWidget();
  // $(document).ready(function(){
     var settings = {
    "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
     // "columnDefs": [
     //        {
     //            "targets": [ 3 ],
     //            "visible": false
     //        }
     //    ],
    "iDisplayLength": 20,
    "oTableTools": {
        "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
        "aButtons": [{
            "sExtends": "csv",
            "sButtonText": "<i class='pg-grid'></i>",
        }, {
            "sExtends": "xls",
            "sButtonText": "<i class='fa fa-file-excel-o'></i>",
        }, {
            "sExtends": "pdf",
            "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
        }, {
            "sExtends": "copy",
            "sButtonText": "<i class='fa fa-copy'></i>",
        }]
    },
    fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions'));
    }
};


var table = $('#transactions').DataTable(settings);
 $('#transactions tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
  // });
</script>
{{-- 
<script>
  $('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
</script> --}}
@endpush


