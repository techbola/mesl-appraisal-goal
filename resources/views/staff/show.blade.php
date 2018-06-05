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
        <div class="pull-right">
          <a href="{{ route('staff.edit_biodata',[$staff->StaffRef]) }}" title="" class="btn btn-info btn-cons" id="show-modal">
            <i class="fa fa-plus"></i>
            Edit Details
          </a>
        </div>
        <div class="clearfix"></div>


        {{-- START TABS --}}
        <ul class="nav nav-tabs">
    		  <li class=" {{ (isset($_GET['gantt']) || isset($_GET['todos']))? '':'active' }}"><a data-toggle="tab" href="#biodata">BioData</a></li>
    		  <li><a data-toggle="tab" href="#projects">Projects Status</a></li>
    		  <li class="{{ (isset($_GET['gantt']))? 'active':'' }}"><a data-toggle="tab" href="#gantt" onclick="load_gantt()">Gantt Chart</a></li>
    		  <li class="{{ (isset($_GET['todos']))? 'active':'' }}"><a data-toggle="tab" href="#todos" onclick="load_todos()">To-Dos</a></li>
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
        </div>


      </div>
    </div>
    {{-- END CARD --}}


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
