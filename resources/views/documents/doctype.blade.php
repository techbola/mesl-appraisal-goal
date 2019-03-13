@extends('layouts.master')

@push('styles')

	<style>
		.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }

    thead tr {
      font-weight: bold;
      color: #000;
    }

    /* table th, table td {
        width: 80px  !important;
    } */
	</style>
@endpush

@section('content')

    <div class="card-box">
        <div class="card-title">Document Type</div>

        <form action="{{ route('StoreDoctype') }}" method="POST" class="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('DocType', 'Document Type' ) }}
                            {{ Form::text('DocType', null, ['class' => 'form-control', 'placeholder' => 'Enter Document Type', 'required']) }}
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('DocCategory', 'Document Category' ) }}
                            <select name="DocCategory" class="full-width" data-init-plugin="select2" id="" onchange="">
                                <option value=" ">Select Document Category</option>
                                @foreach($doc_category as $item)
                                    <option value="{{ $item->DocCategoryRef }}">{{ $item->DocCategory }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="CompanyID" value="17">
    
    
            <div class="row">
                <div class="pull-right">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
        </form>

    </div>

    {{-- Table --}}
    <div class="card-box">
        <div class="card-title">Entries</div>
        <table class="table tableWithSearch table-bordered">
            <thead>
                <th width="10%">Document Type</th>
                <th width="7%">Document Category</th>
                <th width="7%">Company</th>
                <th width="15%">Action</th>
            </thead>
            <tbody>
                @foreach($doctypes as $doctype)
                    <tr>
                        <td>{{$doctype->DocType}}</td>
                        <td>{{$doctype->category->DocCategory ?? ''}}</td>
                        <td>{{$doctype->staff_company->Company ?? ''}}</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_doctype({{$doctype->DocTypeRef}})" data-toggle="modal" data-target="#exampleModal">Edit</button>
                            <a href="/documents/doctype/{{$doctype->DocTypeRef}}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Doc Type</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="DocTypeRef" name="DocTypeRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('DocType', 'Document Type' ) }}
                                        {{ Form::text('DocType', null, ['class' => 'form-control', 'id' => 'doc_type', 'placeholder' => 'Edit Doc Type', 'required']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="controls">
                                <div class="form-group">
                                    {{ Form::label('DocCategory', 'Document Category' ) }}
                                    <select name="DocCategory" class="full-width" data-init-plugin="select2" id="doc_category" onchange="">
                                        <option value=" ">Select Document Category</option>
                                        @foreach($doc_category as $item)
                                            <option value="{{ $item->DocCategoryRef }}">{{ $item->DocCategory }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="CompanyID" value="17">
                
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>



@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>

    function edit_doctype(id)
    {
            $.get('/edit_doc_type/'+id, function(data, status) {

            $('#DocTypeRef').val(data.DocTypeRef);
            $('#doc_type').val(data.DocType);

            $('#doc_category').val(data.DocCategory).trigger('change');

            $('#form-edit').prop('action', '/update_doc_type');
            
        });

    }
</script>