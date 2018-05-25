@extends('layouts.master')

{{-- @section('buttons')
  <a href="{{ route('create_call_memo') }}" class="btn btn-sm btn-info btn-rounded">New Memo</a>
@endsection --}}

@section('title')
  New Call Memo
@endsection

@section('content')

  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      <div class="card-box">
        <div class="card-title">
          Create Call Memo - {{ $contact->Customer }}
        </div>

        <form class="" action="index.html" method="post">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Attendees</label>
                <input type="text" class="form-control" name="Attendees" placeholder="Attendees">
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
            <div class="col-md-6">
              <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" name="Location" placeholder="Location">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Meeting Date</label>
                <div class="input-group date dp">
                  <input type="text" class="form-control" name="MeetingDate" placeholder="MeetingDate">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>

          <hr>
          <button type="button" id="add_discussion" class="btn btn-inverse btn-sm pull-right m-t-10 m-b-20">+ Discussion Point</button>
          <div class="clearfix"></div>

          <div id="discussions" class="">

          </div>


          <div class="m-t-20">
            <input type="submit" class="btn btn-lg btn-success" value="Submit">
          </div>


        </form>
      </div>

    </div>
  </div>

@endsection

@push('scripts')
  <script>
    var discussions = $('#discussions');
    var count_d = 0;
    $('#add_discussion').on('click', function(){
      count_d++;
      discussions.append(`
        <div class="row m-b-10">
          <div class="col-md-10">
            <input type="text" name="discussions[]" class="form-control" placeholder="Discussion Point">
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-info btn-block add_action" onclick="add_action(this)">+ Action Point</button>
          </div>
          <div id="" class="row actions_box"></div>
        </div>
        `);
    });

    function add_action(btn){
      btn.closest(".row").find('.actions_box').append('Hello');
    };
  </script>
@endpush
