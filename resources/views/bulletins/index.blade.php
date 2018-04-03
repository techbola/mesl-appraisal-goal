@extends('layouts.master')

@section('title')
  Bulletin Board
@endsection

@section('page-title')
  Bulletin Board
@endsection

@section('content')
  <style>
    .bulletin-text, .bulletin-text * {
      font-size: 15px !important;
    }
  </style>
  <div class="btn btn-sm btn-info pull-right m-b-10" data-toggle="modal" data-target="#new_bulletin">New Bulletin</div>
  <div class="clearfix"></div>

  <div class="">

    @foreach ($bulletins as $item)
      <div class="card-box">
        <div class="thumbnail-wrapper d48 circular">
          <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar) }}">
        </div>

        <div class="inline m-l-15">
          <h4 class="page-title" style="font-size:17px; margin-top:0 !important">{{ $item->Title }}</h4>
          <p class="no-margin text-muted">
            Posted by <b class="text-info">{{ $item->poster->FullName }}</b>, {{ ($item->CreatedDate->isToday())? 'Today' : 'on '.$item->CreatedDate->format('jS M, Y') }} at {{ $item->CreatedDate->format('g:ia') }}
          </p>
        </div>

        <hr>
        <div class="bulletin-text">
          {!! nl2br($item->Body) !!}
        </div>

      </div>
    @endforeach

    <div class="text-center">
      {{ $bulletins->links() }}
    </div>

  </div>



  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_bulletin" tabindex="-1" role="dialog" aria-hidden="false">
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
