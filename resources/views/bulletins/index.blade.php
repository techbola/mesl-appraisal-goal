@extends('layouts.master')

@section('title')
  Bulletin Board
@endsection

@section('page-title')
  Bulletin Board
@endsection

@section('buttons')
  <div class="btn btn-sm btn-info pull-right m-b-10" data-toggle="modal" data-target="#new_bulletin">New Bulletin</div>
@endsection

@section('content')
  <style>
    .bulletin-text, .bulletin-text * {
      font-size: 15px !important;
    }
  </style>

  <div class="clearfix"></div>

  <div class="">

    {{-- START TABS --}}
    <ul class="nav nav-tabs outside">
      <li class="active"><a data-toggle="tab" href="#board">Board <span class="badge badge-danger badge-sm badge-tab">{{ count($bulletins) }}</span></a></li>
      <li><a data-toggle="tab" href="#archived">Archived</a></li>
    </ul>
    <div class="tab-content">
      <div id="board" class="tab-pane fade in active">

        @include('bulletins.board_block')

      </div>
      <div id="archived" class="tab-pane fade">

        @include('bulletins.archives_block')

      </div>
    </div>
    {{-- END TABS --}}



  </div>



  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_bulletin" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Post New Bulletin Item</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

            <form action="{{ route('save_bulletin') }}" method="post">
              {{ csrf_field() }}
              <div class="">

              </div>

              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="Title" placeholder="Enter announcement title" required>
              </div>

              <div class="form-group">
                <label>Select Recipient Department</label>
                <select class="form-control select2" name="DepartmentID" data-init-plugin="select2" required>
                  <option value=""> -- Select Department --</option>
                  @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                {{ Form::label('ExpiryDate', 'Expiry Date' ) }}
                <div class="input-group date dp">
                  {{ Form::text('ExpiryDate', null, ['class' => 'form-control', 'placeholder' => 'Expiry Date', 'required']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>

              <div class="form-group">
                {{ Form::label('Body', 'Body' ) }}
                {{ Form::textarea('Body', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter announcement text', 'rows' => '6']) }}
              </div>

              <button type="submit" class="btn btn-info btn-form">Submit</button>
            </form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection


@push('scripts')
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/css/summernote.css') }}" />
  <script src="{{ asset('assets/plugins/summernote/js/summernote.min.js') }}" charset="utf-8"></script>
  <script>
    $('.summernote').summernote({
      // height: '100px',
      placeholder: 'Enter your message here',
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['strikethrough', 'superscript', 'subscript']],
        // ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        // ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
      ]
    });
  </script>
@endpush
