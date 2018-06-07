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

      <form action="{{ route('send_message') }}" method="post">
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

            {{-- <input type="submit" class="btn btn-success m-t-10" value="Send"> --}}
            <button type="submit" class="btn btn-info m-t-20"><i class="fa fa-paper-plane m-r-5"></i> Send</button>
          </div>
        </div>

      </form>

    </div>
  </div>

@endsection

@push('scripts')

@endpush
