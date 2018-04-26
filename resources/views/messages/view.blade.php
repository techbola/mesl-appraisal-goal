@extends('layouts.master')

@section('title')
  Message: <span class="text-info m-l-5">{{ $message->Subject }}</span>
@endsection

@section('page-title')
  Message: <span class="text-info m-l-5">{{ $message->Subject }}</span>
@endsection

@section('content')

  <style>
    .note-editable {
      min-height: 100px;
      background: #ffffff !important;
    }
  </style>

  <div class="row">
    @include('messages.menu', ['active' => 'nothing'])
    <div class="col-sm-8 col-md-9">

      <div class="card-box">
        <h4 class="m-t-0 m-b-20 semi-bold">{{ $message->Subject }}</h4>

        {{-- START REPLIES --}}
        @foreach ($message->replies as $reply)
          <div class="thumbnail-wrapper d39 circular">
            <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$reply->sender->avatar()) }}">
          </div>
          <div class="inline m-l-10" style="vertical-align: -webkit-baseline-middle">
            <p class="no-margin bold f15">{{ $reply->sender->FullName }}</p>
          </div>
          <p class="no-margin text-muted pull-right">
            {{ ($reply->created_at->isToday())? 'Today' : $reply->created_at->format('jS M, Y') }} at {{ $reply->created_at->format('g:ia') }}
          </p>
          <div class="clearfix"></div>

          <div class="f15 m-t-10 m-b-20 inbox-message">
            {!! $reply->Body !!}
          </div>
          <hr>
        @endforeach
        {{-- END REPLIES --}}

        <div class="thumbnail-wrapper d48 circular">
          <img width="40" height="40" alt="" data-src-retina="{{ asset('images/avatars/'.$message->sender->avatar()) }}" data-src="{{ asset('images/avatars/'.$message->sender->avatar()) }}" src="{{ asset('images/avatars/'.$message->sender->avatar()) }}">
        </div>
        <div class="inline m-l-10">
          <p class="no-margin bold f15">{{ $message->sender->FullName }}</p>
          <p class="no-margin text-muted">
            {{ ($message->created_at->isToday())? 'Today' : $message->created_at->format('jS M, Y') }} at {{ $message->created_at->format('g:ia') }}
          </p>
        </div>

        <div class="clearfix"></div>

        @if (count($message->recipients) > 1)
          <div class="m-t-20 m-b-10 small">
            <b>To:</b> <span>{{ implode(', ', $message->recipients->pluck('FullName')->toArray()) }}</span>
          </div>
        @endif
        <hr>


        <div class="f15 m-t-20 m-b-20 inbox-message">
          {!! $message->Body !!}
        </div>
        <hr>


        <div class="m-t-35">
          <form action="{{ route('reply_message', $message->MessageRef) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Reply</label>
              <textarea class="summernote" name="Body"></textarea>

              {{-- <input type="submit" class="btn btn-success m-t-10" value="Send"> --}}
              <button type="submit" class="btn btn-success m-t-20"><i class="fa fa-paper-plane m-r-5"></i> Send Reply</button>
            </div>
          </form>
        </div>

      </div>


    </div>
  </div>



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
