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
        <div class="card-title">Sub Category</div>

        <form action="{{ route('StoreDocCat') }}" method="POST" class="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('DocCategory', 'Document Category' ) }}
                            {{ Form::text('DocCategory', null, ['class' => 'form-control', 'placeholder' => 'Enter Document Category', 'required']) }}
                        </div>
                    </div>
                </div>
    
            </div>
    
            <div class="row">
                <div class="pull-right">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
        </form>

    </div>

    {{-- Table --}}
    <div class="card-box">
        <div class="card-title">Categories</div>
        <table class="table tableWithSearch table-bordered">
            <thead>
                <th width="10%">Document Category</th>
                <th width="15%">Date Created</th>
                <th width="15%">Action</th>
            </thead>
            <tbody>
                @foreach($doccategories as $doccategory)
                    <tr>
                        <td>{{$doccategory->DocCategory}}</td>
                        <td>{{$doccategory->created_at}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" onclick="edit_doccategory( {{$doccategory->DocCategoryRef}})" data-toggle="modal" data-target="#exampleModal">Edit</button>
                            <a href="{{ route('delete_doc_category', $doccategory->DocCategoryRef) }}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
              <h5 class="modal-title" id="exampleModalLabel">Edit Document Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" method="POST" class="form-edit">
                    <input type="hidden" id="DocCategoryRef" name="DocCategoryRef" value="">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="controls">
                                <div class="form-group">
                                    {{ Form::label('DocCategory', 'Document Sub Category' ) }}
                                    {{ Form::text('DocCategory', null, ['class' => 'form-control', 'id' => 'doc_category', 'placeholder' => 'Enter doc Category', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>
            
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

    function edit_doccategory(id)
    {
            $.get('/edit_doc_category/'+id, function(data, status) {

            $('#doc_category').val(data.DocCategory);

            $('#DocCategoryRef').val(data.DocCategoryRef);

        $('#form-edit').prop('action', '/update_doc_category');    
        });

    }
</script>