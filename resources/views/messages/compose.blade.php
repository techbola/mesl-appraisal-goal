@extends('layouts.master')

@section('title')
  Messages - Compose
@endsection

@section('page-title')
  Messages - Compose
@endsection

@section('content')

  <div class="row">
    @include('messages.menu', ['active' => 'compose'])
    <div class="col-sm-8 col-md-9 inbox-content">

      <form action="{{ route('send_message') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group-attached">
          <div class="row clearfix">
            <div class="col-md-12">
              <div class="form-group form-group-default">
                <label>TO:</label>
                <select name="to[]" data-init-plugin="select2" class="form-control" multiple required>
                  @foreach ($staffs as $staff)
                    <option value="{{ $staff->UserID }}">{{ $staff->FullName }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            {{-- <div class="col-md-6">
              <div class="form-group form-group-default">
              <label>CC:</label>
              <input type="text" class="form-control" name="cc" placeholder="Add Carbon Copy">
            </div>
          </div> --}}
          </div>
          <div class="form-group form-group-default">
            <label>Subject</label>
            <input type="text" class="form-control" name="Subject" required>
          </div>
          <div class="form-group form-group-default">
            <label>Message</label>
            <textarea class="summernote" name="Body" placeholder="Enter your message here."></textarea>
          </div>

            <div class="form-group form-group-default">

              {{-- Attached Files --}}
              <ul class="my-list" id="files">
              </ul>

              {{-- End Attached Files --}}

              <div class="clearfix m-t-30 m-b-20">
                <div class="pull-left btn btn-inverse m-t-10" id="add_file">
                  <i class="fa fa-plus m-r-5"></i> Attach File
                </div>
                <button type="submit" class="pull-right btn btn-lg btn-info"><i class="fa fa-paper-plane m-r-5"></i> Send</button>
              </div>

            </div>

        </div>

      </form>

    </div>
  </div>

@endsection

@push('scripts')
  {{-- Append Files --}}
  <script>
    var files = $('#files');
    $('#add_file').on('click', function(){
      files.append(`
        <li class="row m-t-5 clearfix">
          <input type="file" class="form-control pull-left m-t-5" name="MessageFiles[]" value="" style="width:90%">
          <i class="fa fa-times-circle text-danger delete f22 pointer"></i>
        </li>
        `);
    });


    $("body").on("click", ".delete", function (e) {
      if (confirm('Remove this file?'))
        // $(this).closest(".row").fadeOut(300).remove();
        $(this).closest(".row").fadeOut(700, function(){
          $(this).remove();
        });
    });
  </script>
@endpush
