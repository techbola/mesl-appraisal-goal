@extends('layouts.master')

@section('title')

@endsection

@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <div class="card-box">
        <div class="card-title">Edit Action Point</div>

        @include('errors.list')
        <form class="" action="{{ route('update_action_point', $action->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}

          <div class="form-group">
            <label for="">Action Point</label>
            {{-- <input type="text" name="ActionPoint" class="form-control" placeholder="Enter action point"> --}}
            <div id="action_text">{{ $action->ActionPoint }}</div>
          </div>
          <div class="form-group">
            <label>Comment</label>
            <textarea name="Comment" rows="2" class="summernote form-control" placeholder="Enter comments.">{{ $action->Comment }}</textarea>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select data-init-plugin="select2" class="full-width select2" name="StatusID">
              @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ ($status->id == $action->StatusID)? 'selected':'' }}>{{ $status->Status }}</option>
              @endforeach
            </select>
          </div>


          <div class="clearfix"></div>

          <div class="text-right m-t-20">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
        </form>

      </div>

    </div>
  </div>


@endsection
