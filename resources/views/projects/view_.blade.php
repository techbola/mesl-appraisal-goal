@extends('layouts.master')

@section('title')
  Project - {{ $project->Project }}
@endsection

@section('page-title')
  Project: <b>{{ $project->Project }}</b>
@endsection

@section('buttons')
  <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_project"><i class="icon-pencil m-r-5"></i>Edit Project</a>
  {{-- <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a> --}}
@endsection

@section('content')

  <style>
    .brief * {
      font-size: 15px !important;
    }
  </style>

  <!-- Page-Title -->
  {{-- <div class="row m-b-15">
    <div class="col-sm-12 clearfix">
      <h4 class="page-title pull-left">
        <span class="text-muted font-title">Project:</span> {{ $project->Project }}
      </h4>

      <div class="pull-right">
        <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_project"><i class="icon-pencil m-r-5"></i>Edit Project</a>
        <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
      </div>
    </div>
  </div> --}}
  <!-- End Page Title -->


  <!-- Start Project Details -->

  <div class="row">

    <div class="col-sm-12">
      <div class="card-box widget-inline">
        <!-- Start Progress -->
        <div class="row container-fluid">
          <div class="col-md-12 m-b-20 p-l-r-10">
            <!-- <label>Progress:</label> -->

            <div class="clearfix">
              <div class="pull-left">
                <!-- PROJECT STATUS -->
                  <div class="text-{{ $project->status->color }} m-b-7 f15"><b><i class="{{ $project->status->icon }} m-r-5"></i> {{ $project->status->name }}</b></div>
                <!-- END PROJECT STATUS -->
              </div>

              <!-- Start: Days Left -->
              <div class="pull-right text-muted">
                <i class="fa fa-clock-o"></i> {{ $project->days_left }}
              </div>
              <!-- End: Days Left -->
            </div>
            <div class="progress progress-striped active progress-lg m-b-0">
              <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $project->progress_percent }}">
                {{ $project->progress_percent }}
              </div>
            </div>
          </div>
        </div>
        <!-- End Progress -->
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">Customer</div>
              <div class="f18"><b>{{ $project->customer->Customer ?? '-' }}</b>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">Vendor</div>
              <div class="f18"><b>{{ $project->vendor->Customer ?? '-' }}</b>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">Supervisor</div>
              <div class="f18"><b>{{ $project->supervisor->FullName ?? '-'}}</b></div>
            </div>
          </div>

          <div class="col-lg-2 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">Start Date</div>
              <div class="f18"><b>{{ date('j M. Y', strtotime($project->StartDate)) }}</b></div>
            </div>
          </div>

          <div class="col-lg-2 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">End Date</div>
              <div class="f18"><b>{{ date('j M. Y', strtotime($project->EndDate)) }}</b></div>
            </div>
          </div>

          {{-- <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div>
                <span class="text-muted">Start Date</span>
                <span class="f15 m-l-5"><b>{{ date('j M. Y', strtotime($project->StartDate)) }}</b></span>
              </div>
              <div class="m-t-5">
                <span class="text-muted">End Date</span>
                <span class="f15 m-l-5"><b>{{ date('j M. Y', strtotime($project->EndDate)) }}</b></span>
              </div>
            </div>
          </div> --}}

        </div>

      </div>
    </div>
  </div>
  <!-- End Project Details -->


  {{-- START TABS --}}
  <ul class="nav nav-tabs outside">
    <li class="active"><a data-toggle="tab" href="#details">Project Details</a></li>
    <li><a data-toggle="tab" href="#gantt">Gantt Chart</a></li>
    <li>
      <a data-toggle="tab" href="#files">Files <span class="badge badge-inverse badge-tab">{{ count($project->files) }}</span></a>
    </li>
  </ul>
  <div class="tab-content">
    <div id="details" class="tab-pane fade in active">
      @include('projects.details')
    </div>
    <div id="gantt" class="tab-pane fade">
      {{-- Start Gantt --}}
      <div class="card-box">
        <div id="gantt_chart"></div>
      </div>
      {{-- End Gantt --}}
    </div>
    <div id="files" class="tab-pane fade">
      @include('projects.files')
    </div>
  </div>
  {{-- END TABS --}}


  <!-- EDIT Modal -->
  <div class="modal fade slide-up" id="edit_project" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit Project</h5>
          </div>
          <div class="modal-body">
            {{ Form::model($project, ['route' => ['update_project', $project->ProjectRef], 'method'=>'patch']) }}
              @include('projects.form')
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- END EDIT MODAL --}}

  {{-- START USER TASKS MODAL --}}
  <div class="modal fade slide-up" id="user_tasks" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5><b>@{{ name }}</b>'s Tasks In {{ $project->Project }}</h5>
          </div>
          <div class="modal-body">


            <ul class="my-list{{ (count($project->tasks) > 7)? ' nicescroll mx-box':'' }}">

              <li v-for="task in tasks">

                <a v-bind:href="'/task/' + task.TaskRef">
                  <div>
                    @{{ task.Task }}
                    <div v-if="task.progress != 100" class="pull-right">
                      @{{ task.progress_percent }}
                    </div>
                    <div v-else class="pull-right">
                      Complete
                    </div>
                  </div>
                </a>
                <div class="small m-b-5"></div>

                <div class="progress progress-striped active progress-sm m-b-0">
                  <div class="progress-bar progress-bar-success" role="progressbar" v-bind:style="{ width: task.progress_percent }">
                    <span class="sr-only">@{{ task.progress }} Complete</span>
                  </div>
                </div>
              </li>

            </ul>

          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- START USER TASKS MODAL --}}


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



  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/css/summernote.css') }}" />
  <script src="{{ asset('assets/plugins/summernote/js/summernote.min.js') }}" charset="utf-8"></script>
  <script>
    $('.summernote').summernote();
  </script>


  <script>
    $('#file_upload_form').on('submit', function(){
      $('#spinner').show();
    });
  </script>
@endpush

@push('vue')

  <script>

    new Vue({
      el: '#app',
      data: {
        tasks: {},
        name: '',
      },
      methods: {
        user_tasks(tasks, name) {
          this.tasks = tasks;
          this.name = name;
        },
      },
    });
  </script>
@endpush
