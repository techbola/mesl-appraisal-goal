@extends('layouts.master')

@section('title')
  {{ $litigation->CaseNumber }}
@endsection

@section('page-title')
  Litigation Schedule For: <b>{{ $litigation->CaseNumber }}</b>
@endsection

@section('buttons')
  <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_litigation"><i class="icon-pencil m-r-5"></i>Edit Schedule</a>
  {{-- <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a> --}}
@endsection

@section('content')

  <style>
    .brief * {
      font-size: 15px !important;
    }
  </style>



  <div class="row">

    <div class="col-sm-12">
      <div class="card-box widget-inline">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Case Number</div>
              <div class="f20"><b>{{ $litigation->CaseNumber ?? '-' }}</b>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Parties</div>
              <div class="f20"><b>{{ $litigation->Parties ?? '-'}}</b></div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Created On</div>
              <div class="f20"><b>{{ date('j M. Y', strtotime($litigation->created_at)) }}</b></div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Adjournment Date</div>
              <div class="f20"><b>{{ !is_null($litigation->AdjournedDate) ? date('j M. Y', strtotime($litigation->AdjournedDate)) : '-' ?? '-' }}</b></div>
            </div>
          </div>

          

        </div>

      </div>
    </div>
  </div>
  <!-- End Project Details -->


  {{-- START TABS --}}
  <ul class="nav nav-tabs outside">
    <li class="active"><a data-toggle="tab" href="#details">Litigation Details</a></li>
    <li><a data-toggle="tab" href="#status">Status Updates <span class="badge badge-info badge-sm m-l-5">{{ count($litigation->comments) }}</span></a> </li>
    <li>
      <a data-toggle="tab" href="#files">Files <span class="badge badge-inverse badge-tab">{{-- count($litigation->files) --}}</span></a>
    </li>
  </ul>
  <div class="tab-content">
    <div id="details" class="tab-pane fade in active">
      @include('litigation.details')
    </div>
    <div id="status" class="tab-pane fade">
      <div class="card-box">
        @foreach($statuses->sortByDesc('created_at') as $status)
          <div class="pull-right">
            {{ date('j M. Y @ H:i', strtotime($status->created_at)) }}
          </div>
          <div class="div clearfix"></div>
          {!! $status->LitigationStatus ?? '-' !!} 
          @if (!$loop->last)
              <hr>
          @endif
        @endforeach
      </div>
    </div>
    <div id="files" class="tab-pane fade">
      @include('litigation.files')
    </div>
  </div>
  {{-- END TABS --}}

  <!-- EDIT Modal -->
  <div class="modal fade slide-up" id="edit_litigation" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit Project</h5>
          </div>
          <div class="modal-body">
            {{ Form::model($litigation, ['route' => ['litigation.update', $litigation->LitigationRef], 'method'=>'patch']) }}
              @include('litigation.form')
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- END EDIT MODAL --}}


@endsection

@push('scripts')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
  <script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            autoclose: true,
        };
        $('.dp').datepicker(options);
    });
  </script>



  {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/css/summernote.css') }}" />
  <script src="{{ asset('assets/plugins/summernote/js/summernote.min.js') }}" charset="utf-8"></script> --}}
  <script>
    $('.summernote').summernote();
  </script>

  <script>
    $('#file_upload_form').on('submit', function(){
      $('#spinner').show();
    });
  </script>
@endpush


