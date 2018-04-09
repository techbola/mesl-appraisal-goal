@extends('layouts.master')

@section('title')
	Event: {{ $event->Event }}
@endsection

@section('page-title')
	Viewing Event: <span class="text-info">{{ $event->Event }}</span>
@endsection

@section('buttons')
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#edit_event">Edit</button>
		<button class="btn btn-danger btn-rounded m-l-5" onclick="confirm2('Delete this event?', '', 'delete_form')">Delete</button>
@endsection

@section('content')
  <form class="hidden" id="delete_form" action="{{ route('delete_event', $event->EventRef) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

  </form>
  <div class="card-box">
    <div class="card-title">{{ $event->Event }}</div>
    <div class="m-t-20 m-b-15"><span class="label label-info btn-rounded">{{ Carbon\Carbon::parse($event->StartDate)->format('jS M Y') }}</span> to <span class="label label-info btn-rounded">{{ Carbon\Carbon::parse($event->EndDate)->format('jS M Y') }}</span></div>

    <div class="f13 m-b-15"><b>Posted by
      <img width="22" height="22" alt="" src="{{ asset('images/avatars/'.$event->poster->avatar) }}" style="border-radius:50%">
      <span class="">{{ $event->poster->FullName }}</span>
      </b>
    </div>

    <div class="">
      {!! nl2br($event->Description) !!}
    </div>
  </div>

  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="edit_event" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit Event: {{ $event->Event }}</h5>
          </div>
          <div class="modal-body">
            {{-- <form action="{{ route('save_event') }}" method="post">
              {{ csrf_field() }}
              @include('events.form')
            </form> --}}
            {{ Form::model($event, ['action' => ['EventScheduleController@update_event', $event->EventRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
        		  {{ method_field('PATCH') }}
              @include('events.form')
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- End Modal --}}
@endsection


@push('scripts')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
  <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
@endpush
