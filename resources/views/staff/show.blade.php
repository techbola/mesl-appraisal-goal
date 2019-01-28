@extends('layouts.master')

@push('styles')
  <link href='https://fonts.googleapis.com/css?family=Jaldi:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/style-white.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/loading/progress/loading-bar.css') }}">
@endpush

@section('buttons')
    <a class="btn btn-sm btn-info btn-rounded" href="/staff">Back to Employees</a>
@endsection

@section('content')
  <style media="screen">
  .bio-label {
    font-weight: bold;
    font-size: 15px;
  }
  /* .card-box:nth-child(odd) {

  } */

  .ldBar {
    width:40px !important;
    height: 40px !important;
    margin:auto;
    position: absolute;
    right: 50px;
    top: 0;
    z-index: 9999;
    font-size: 15px;
  }
  </style>

    {{-- START CARD --}}
    <div class="card-box">
      <div class="p-l-20 p-r-20">
        <div class="card-title pull-left">
          {{ $staff->FullName }}'s BioData
        </div>

        @can ('edit-profile', $staff->user)
          <div class="pull-right">
            <a href="{{ route('staff.edit_biodata',[$staff->StaffRef]) }}" title="" class="btn btn-info btn-cons" id="show-modal">
              <i class="fa fa-plus"></i>
              Edit Details
            </a>
            @if (!$staff->is_disengaged && !$staff->user->hasRole('admin') && Gate::allows('hr-admin'))
              <a class="btn btn-danger" onclick="confirm2('Disengage this staff?', '', 'disengage_form')">
                <i class="fa fa-times"></i> Disengage
              </a>
              <form class="hidden" id="disengage_form" action="{{ route('disengage', $staff->UserID) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
              </form>
            @endif
          </div>
        @endcan

        <div class="clearfix"></div>


        {{-- START TABS --}}
        <ul class="nav nav-tabs">
    		  <li class=" {{ (isset($_GET['gantt']) || isset($_GET['todos']))? '':'active' }}"><a data-toggle="tab" href="#biodata">BioData</a></li>
    		  <li><a data-toggle="tab" href="#projects">Projects Status</a></li>
    		  <li class="{{ (isset($_GET['gantt']))? 'active':'' }}"><a data-toggle="tab" href="#gantt" onclick="load_gantt()">Gantt Chart</a></li>
    		  <li class="{{ (isset($_GET['todos']))? 'active':'' }}"><a data-toggle="tab" href="#todos" onclick="load_todos()">To-Dos</a></li>
    		  <li><a data-toggle="tab" href="#scorecard">Score Card</a></li>
    		  <li><a data-toggle="tab" href="#updates">Task Update Reports</a></li>
          <li><a data-toggle="tab" href="#files">Files <span class="badge">{{ $docs_count }}</span></a> </li>
    		</ul>

        <div class="tab-content">
          <div id="biodata" class="tab-pane fade {{ (isset($_GET['gantt']) || isset($_GET['todos']))? '':'in active' }}">
            @include('staff.block_biodata')
          </div>
          <div id="projects" class="tab-pane fade">
            @include('staff.block_projects')
          </div>
          <div id="gantt" class="tab-pane fade {{ (isset($_GET['gantt']))? 'in active':'' }}">
            @if (isset($_GET['gantt']))
              @include('staff.block_gantt')
            @endif
          </div>
          <div id="todos" class="tab-pane fade {{ (isset($_GET['todos']))? 'in active':'' }}">
            @if (isset($_GET['todos']))
              @include('staff.block_todos')
            @endif
          </div>
          <div id="scorecard" class="tab-pane fade">
            @include('staff.block_scorecard')
          </div>
          <div id="updates" class="tab-pane fade">
            @include('staff.block_updates')
          </div>
          <div id="files" class="tab-pane fade">
            <div>
              <button class="btn btn-info btn-rounded pull-right" data-toggle="modal" data-target="#new_doc">Upload Document</button>
            </div>
            {{-- @include('staff.files') --}}
            <table class="table tableWithSearch table-striped table-bordered">
              <thead>
                <th width="20%">Document Name</th>
                <th width="15%">Type</th>
                <th width="20%">Upload Date</th>
                <th width="15%">Uploaded By</th>
                <th width="15%">Approved By</th>
                <th width="15%">Download</th>

              </thead>
              <tbody>
                @foreach ($docs as $doc)
                  <tr>
                    <td><b>{{ $doc->DocName ?? '' }}</b></td>
                    <td>{{ $doc->doctype->DocType ?? '' }}</td>
                    <td>{{ date('jS M, Y - g:ia', strtotime($doc->UploadDate)) }}</td>
                    <td>{{ $doc->initiator->FullName ?? '-' }}</td>
                    <td>{{ ($doc->approver)? $doc->approver->FullName : '-' }}</td>
                    {{-- <td><a href="#" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
                    {{-- <td><a href="{{ $doctype->Path}}" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
                    <td><a href="{{ route('docs', ['file'=>$doc->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $doc->Filename}}<i class="fa fa-download m-l-5"></i></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>


      </div>
    </div>
    {{-- END CARD --}}

    {{--  --}}
      <!-- Create Modal -->
    <div class="modal fade slide-up disable-scroll" id="new_doc" role="dialog" aria-hidden="false">
      <div class="modal-dialog ">
        <div class="modal-content-wrapper">
          <div class="modal-content">
            <div class="modal-header clearfix text-left">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
              </button>
              <h5>Upload New Document</h5>
            </div>
            <div class="modal-body">
              <form action="{{ route('document_store_hr') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('documents.hr_form')
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--  --}}


  @endsection

  @push('scripts')
    <script src="{{ asset('assets/plugins/cd/accordion/main.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/loading/progress/loading-bar.min.js') }}" charset="utf-8"></script>

    <script>
      function load_gantt() {
        window.location = '{{ url()->current() }}?gantt';
      }
      function load_todos() {
        window.location = '{{ url()->current() }}?todos';
      }
    </script>
  @endpush
