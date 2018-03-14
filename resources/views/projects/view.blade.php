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
              <div class="text-muted">Client</div>
              <div class="f20"><b>{{ $project->client->Name ?? '-' }}</b>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">Supervisor</div>
              <div class="f20"><b>{{ $project->supervisor->FullName ?? '-'}}</b></div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">Start Date</div>
              <div class="f20"><b>{{ date('j M. Y', strtotime($project->StartDate)) }}</b></div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted">End Date</div>
              <div class="f20"><b>{{ date('j M. Y', strtotime($project->EndDate)) }}</b></div>
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

  <!-- Start: Project Description -->
  <div class="card-box">
    <h4 class="card-title">Project Description / Brief</h4>
    {{ nl2br($project->Description) ?? 'No Description Provided' }}
  </div>

  {{-- <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <h4 class="m-t-0 m-b-20 font-title"><b>Description</b></h4>
        <div>{{ nl2br($project->Description) }}</div>
      </div>
    </div>
  </div> --}}
  <!-- End: Project Description -->

  <div class="row">
    <div class="col-md-4">
      <div class="card-box">
        <h4 class="card-title">Project Tasks <span class="badge badge-info badge-sm m-l-5">{{ count($project->tasks) }}</span></h4>


        {{-- TASK LIST --}}

        <ul class="my-list{{ (count($project->tasks) > 7)? ' nicescroll mx-box':'' }}">

        @foreach ($project->tasks as $task)

          <li>
            <a href="{{ route('view_task', $task->TaskRef) }}">
              <div>
                {{ $task->Task }}
                @if($task->progress != 100)
                  <span class="pull-right">{{ $task->progress_percent }}</span>
                @else
                  <span class="pull-right">Complete</span>
                @endif
              </div>
            </a>
            <div class="small m-b-5">
            @if($task->staff)
              <b>Assigned To:</b> {{ $task->staff->FullName }}
            @else
                Unassigned
            @endif
            </div>
            <div class="progress progress-striped active progress-sm m-b-0">
              <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $task->progress_percent }}">
                <span class="sr-only">{{ $task->progress_percent }} Complete</span>
              </div>
            </div>

          </li>
        @endforeach

      </ul>
        {{-- END TASK LIST --}}

        <a href="#add_task" class="btn btn-sm btn-info btn-block m-t-20" data-toggle="collapse" class="collapsed">Add Task</a>

        <div class="panel-collapse collapse" id="add_task">
          <form class="m-t-15" action="{{ route('save_task') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Title:</label>
              <input type="text" name="Task" class="form-control" placeholder="Enter Task Title" required>
            </div>
            <div class="form-group">
              {{ Form::label('Assign To') }}
              {{ Form::select('StaffID', [''=>'Assign To...'] + $staffs->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Assign this task to...", 'data-init-plugin' => "select2", 'required']) }}
            </div>
            <input type="hidden" name="ProjectID" value="{{ $project->ProjectRef }}">
            <div class="clearfix">
              <input type="submit" name="add_task" class="btn btn-info col-sm-5" value="Save">
              <a href="#add_task" class="btn btn-inverse col-sm-5 col-sm-offset-2" data-toggle="collapse" class="collapsed">Cancel</a>
            </div>

          </form>
        </div>

      </div>
    </div>

    <div class="col-lg-4">
      <div class="card-box">
        <h4 class="card-title"><b>Assignees</b> <span class="badge badge-info badge-sm m-l-5">{{ count($project->assignees) }}</span></h4>

        <div class="my-list{{ (count($project->assignees) > 6)? ' nicescroll mx-box':'' }}">

          @foreach ($project->assignees as $staff)
          {{-- @foreach ($project->tasks as $task) --}}
            <li>
              <ul class="list-inline">
                  <li><img src="{{ asset('images/avatars/default.png') }}" class="img-circle thumb-40" alt=""></li>
                  <li><a href="">{{ $staff->FullName }}</a></li>
              </ul>
            </li>
          @endforeach
        </div>
      </div>

    </div>

    <!-- START UPDATES -->
    <div class="col-lg-4">
      <div class="card-box">
        <h4 class="card-title"><b>Project Updates</b></h4>

        <!-- Show scrollbar if updates are more than 3 -->
        <div class="inbox-widget<?php if(count($project->chats) > 6){ echo ' nicescroll mx-box'; } ?>">

          @if ($project->chats)
            @foreach ($project->chats as $chat)
              <div class="inbox-item m-r-10">

                <div class="inbox-item-img"><img src="{{ asset('images/avatars/default.png') }}" class="img-circle m-r-5" alt=""></div>
                <p class="inbox-item-author text-muted">
                    <a href="">{{ $chat->staff->FullName }}</a>
                    @if($project->supervisor && $chat->staff->StaffRef == $project->supervisor->StaffRef)
                      <i class="fa fa-shield m-l-5"></i>
                    @endif
                </p>

                <p class="inbox-item-text f13">
                  <!-- Start: Delete Update -->
                  <?php if (Session::get('is_admin')) { ?>
                    <a href=""<i class="ion-close-round pull-right text-danger" onclick="return confirm('Are you sure you want to delete this update?')"></i></a>
                  <?php } ?>
                  <!-- End: Delete Update -->
                  {{ $chat->Body }}
                </p>
                <p class="inbox-item-date">{{ $chat->created_at->diffForHumans() ?? '' }}</p>
              </div>
            @endforeach

          @else
            <div class="text-center text-uppercase text-muted">No Updates Yet</div>
          @endif

        </div>
        <!-- Update Posting Permissions: ADMIN / PROJECT SUPERVISOR / TEAM MEMBERS -->

        <form action="{{ route('save_projectchat') }}" method="post" class="m-t-20">
          {{ csrf_field() }}
          <textarea name="Body" rows="4" class="form-control"></textarea>
          <input type="submit" value="Submit" class="btn btn-sm btn-block btn-info m-t-20">
          <input type="hidden" name="ProjectID" value="{{ $project->ProjectRef }}">
        </form>
      </div>

    </div>
    <!-- END UPDATES -->

  </div> {{-- End Row --}}


  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="edit_project" tabindex="-1" role="dialog" aria-hidden="false">
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
@endpush
