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
          {{-- Reply Attachments --}}
          @if (count($reply->files) > 0)
            {{-- <div class="small bold text-muted">Attachments</div> --}}
            <ul class="my-list light">
              @foreach ($reply->files as $file)
                <li class="small text-lowercase">
                  <i class="fa fa-file-o m-r-5 f15"></i> <a href="{{ route('download_file', ['message_files', $file->Filename]) }}" class="" data-toggle="tooltip" title="Download">{{ $file->Filename }}</a>
                </li>
              @endforeach
            </ul>
          @endif
          {{-- End Reply Attachments --}}
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
        {{-- Parent's Attachments --}}
        @if (count($message->files) > 0)
          {{-- <div class="small bold text-muted">Attachments</div> --}}
          <ul class="my-list">
            @foreach ($message->files as $file)
              <li class="small text-lowercase">
                <i class="fa fa-file-o m-r-5 f15"></i> <a href="{{ route('download_file', ['message_files', $file->Filename]) }}" class="" data-toggle="tooltip" title="Download">{{ $file->Filename }}</a>
              </li>
            @endforeach
          </ul>
        @endif
        {{-- End Parent Attachments --}}
        <hr>


        <div class="m-t-35">
          <form action="{{ route('reply_message', $message->MessageRef) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Reply</label>
              <textarea class="summernote" name="Body"></textarea>

              {{-- Add Files --}}
              <ul class="my-list" id="files">
              </ul>

              <div class="btn btn-sm btn-inverse m-t-10 m-b-10" id="add_file">
                <i class="fa fa-plus m-r-5"></i> Add File
              </div>
              {{-- End Add Files --}}

              {{-- <input type="submit" class="btn btn-success m-t-10" value="Send"> --}}
              <div class="">
                <button type="submit" class="btn btn-lg btn-success m-t-20"><i class="fa fa-paper-plane m-r-5"></i> Send Reply</button>
              </div>

            </div>
          </form>
        </div>

      </div>


    </div>
  </div>



@endsection

@push('scripts')
  {{-- Append Files --}}
  <script>
    var files = $('#files');
    // var disc_id = 0;
    $('#add_file').on('click', function(){
      // disc_id++;
      files.append(`
        <li class="row m-t-5 clearfix">
          <input type="file" class="pull-left m-t-5" name="MessageFiles[]" value="" style="width:90%">
          <i class="fa fa-times-circle text-danger delete f22 pointer"></i>
        </li>
        `);
    });

    // Delete Discussions
    $("body").on("click", ".delete", function (e) {
      if (confirm('Remove this item?'))
        // $(this).closest(".row").fadeOut(300).remove();
        $(this).closest(".row").fadeOut(700, function(){
          $(this).remove();
        });
    });
  </script>
@endpush
