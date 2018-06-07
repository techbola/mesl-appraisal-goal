@extends('layouts.master')

@section('page-title')
  New Meeting Note
@endsection

@section('title')
  New Meeting Note
@endsection

@section('content')

  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <div class="card-box">
        <div class="card-title">
          Create a New Meeting Note with <span class="text-muted">{{ $contact->Customer }}</span>
        </div>

        <form class="" action="{{ route('store_call_memo', $contact->CustomerRef) }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Attendees</label>

                <input type="text" class="form-control" name="Attendees" placeholder="Attendees" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Handouts</label>
                <input type="text" class="form-control" name="Handouts" placeholder="Handouts">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" name="Location" placeholder="Location" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Meeting Type</label>
                {{-- <input type="text" class="form-control" name="MeetingType" placeholder="Meeting type" required> --}}
                <select class="form-control select2" name="MeetingTypeID" data-init-plugin="select2" placeholder="Select meeting type">
                  <option value=""></option>
                  @foreach ($meeting_types as $type)
                    <option value="{{ $type->MeetingTypeRef }}">{{ $type->MeetingType }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Meeting Date</label>
                <div class="input-group date dp">

                  <input type="text" class="form-control" name="MeetingDate" placeholder="MeetingDate" required>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              {{-- <div class="form-group">
                <label>Attendees Emails</label>
                <textarea name="Emails" rows="2" class="form-control" placeholder="Enter emails of attendees. Comma separated."></textarea>
              </div> --}}

              <div class="form-group required">
                <label>Attendees Emails</label>
                <span class="help">Type an email, then press enter or comma.</span>
                <input name="AttendeeEmails" class="tagsinput custom-tag-input" type="text" value="" placeholder="Enter emails of attendees."/>
              </div>

            </div>
          </div>
          <hr>
          {{-- <button type="button" id="add_discussion" class="btn btn-inverse pull-right m-t-10 m-b-20"><i class="fa fa-plus"></i> Discussion Point</button> --}}
          <div class="clearfix"></div>

          <div id="discussions" class="">

          </div>


          <div class="m-t-30">
            <button type="button" id="add_discussion" class="btn btn-lg btn-inverse m-r-10"><i class="fa fa-plus"></i> Discussion</button>
            <input type="submit" class="btn btn-lg btn-success" value="Submit">
          </div>


        </form>
      </div>

    </div>
  </div>

@endsection

@push('scripts')

  <script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $('.custom-tag-input').tagsinput({
      confirmKeys: [13, 188],
      trimValue: true
    });

    $('.bootstrap-tagsinput input').blur(function() {
      $('.custom-tag-input').tagsinput('add', $(this).val());
      $(this).val('');
    });
  </script>
  <script>
    var discussions = $('#discussions');
    var disc_id = 0;
    $('#add_discussion').on('click', function(){
      disc_id++;
      discussions.append(`
        <div class="row m-b-10">
          <div class="col-md-10 col-md-offset-1">
            <div class="form-group">
              <label>Discussion Point <span class="badge badge-inverse badge-tab">${disc_id}</span></label><i class="fa fa-times-circle text-danger delete f22 pull-right pointer"></i>
              <textarea name="discussions[]" class="form-control summernote" placeholder="Discussion Point"></textarea>
            </div>
          </div>
        </div>
        `);
        $('.summernote').summernote({
          height: '100px',
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
          ]
        });
    });
    // Delete Discussions
    $("body").on("click", ".delete", function (e) {
      if (confirm('Remove this discussion?'))
        // $(this).closest(".row").fadeOut(300).remove();
        $(this).closest(".row").fadeOut(700, function(){
          $(this).remove();
        });
    });

    // <div class="row m-b-10">
    //   <div class="col-md-10">
    //     <input type="text" name="discussions[disc_${disc_id}]" class="form-control" placeholder="Discussion Point">
    //   </div>
    //   <div class="col-md-2">
    //     <button type="button" class="btn btn-info btn-block add_action" onclick="add_action(this)">+ Action Point</button>
    //   </div>
    //   <div id="" class="row actions_box"></div>
    // </div>


    // function add_action(btn){
    //   var btn = $(btn);
    //   // console.log(btn);
    //   btn.closest(".row").find('.actions_box').append(`
    //     <div class="row">
    //       <div class="col-md-6 col-md-offset-3">
    //         <div class="form-group">
    //           <label>Action point</label>
    //           <input type="text" name="actions[disc_${disc_id}]" class="form-control" id="" placeholder="Enter action point">
    //         <div class="form-group">
    //           <label>Action point</label>
    //           <select name="responsibility[disc_${disc_id}]" class="form-control" id="" placeholder="Select staff">
    //             <option value="">Select staff</option>
    //           </select>
    //         </div>
    //       </div>
    //     </div>
    //   `);
    // };
  </script>
@endpush
