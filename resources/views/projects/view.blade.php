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
              <div class="f20"><b>{{ $project->customer->Customer ?? '-' }}</b>
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
    <div class="brief">{!! $project->Description ?? 'No Description Provided' !!}</div>
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

<div class="row hidden">
  <div class="col-md-4">
    <div class="scrollbar-outer">

      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
      <div class="lorem">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>

    </div>
  </div>
</div>





  <div class="row">
    <div class="col-md-4">
      <div class="card-box">
        <h4 class="card-title">Project Tasks <span class="badge badge-info badge-sm m-l-5">{{ count($project->tasks) }}</span></h4>

        {{-- TASK LIST --}}
        <div style="max-height:400px; overflow-y:auto">
          <ul class="my-list{{ (count($project->tasks) > 3)? ' nicescroll mx-box':'' }}">

            @foreach ($project->tasks as $task)

              <li>
                <a href="{{ route('view_task', $task->TaskRef) }}">
                  <div>
                    {{ $task->Task }}

                  </div>
                </a>
                <div class="small m-b-5">
                  @if($task->staff)
                    <b>Assigned To:</b> {{ $task->staff->FullName }}
                  @else
                    Unassigned
                  @endif
                  {{-- Progress count --}}
                  @if($task->progress != 100)
                    <span class="pull-right">{{ $task->progress_percent }}</span>
                  @else
                    <span class="pull-right text-success">Complete</span>
                  @endif
                  {{-- End progress count --}}
                </div>
                <div class="progress progress-striped active progress-sm m-b-0">
                  <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $task->progress_percent }}">
                    <span class="sr-only">{{ $task->progress_percent }} Complete</span>
                  </div>
                </div>

              </li>
            @endforeach

          </ul>

        </div>

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
              {{ Form::select('StaffID', [''=>'Assign To...'] + $staffs->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "select2 full-width",'data-placeholder' => "Assign this task to...", 'data-init-plugin' => "select2", 'required']) }}
            </div>
            <div class="form-group">
              {{ Form::label('EndDate', 'Due Date' ) }}
              <div class="input-group date dp">
                {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
            <input type="hidden" name="ProjectID" value="{{ $project->ProjectRef }}">
            <div class="clearfix">
              <input type="submit" name="add_task" class="btn btn-success col-sm-5" value="Save">
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
                  <li><img src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" class="img-circle thumb-40" alt=""></li>
                  <li>
                    <a data-toggle="modal" data-target="#user_tasks" @click="user_tasks({{ $project->tasks->where('StaffID', $staff->StaffRef) }}, '{{ $staff->FullName }}')" style="cursor: pointer">{{ $staff->FullName }}</a>
                    @if($project->supervisor && $staff->StaffRef == $project->supervisor->StaffRef)
                      <i class="fa fa-shield m-l-5" data-toggle="tooltip" title="Supervisor" data-placement="right"></i>
                    @endif
                  </li>
              </ul>
            </li>
          @endforeach
        </div>
      </div>

    </div>

    <!-- START UPDATES -->
    <div class="col-lg-4">
      <div class="card-box">
        <h4 class="card-title"><b>Project Chat</b></h4>

        <!-- Show scrollbar if updates are more than 3 -->
        <div class="inbox-widget<?php if(count($project->chats) > 6){ echo ' nicescroll mx-box'; } ?>">

          @if ($project->chats)
            @foreach ($project->chats as $chat)
              <div class="inbox-item m-r-10">

                <div class="inbox-item-img"><img src="{{ asset('images/avatars/'.$chat->staff->user->avatar()) }}" class="img-circle m-r-5" alt=""></div>
                <p class="inbox-item-author text-muted">
                    <a href="">{{ $chat->staff->FullName }}</a>
                    @if($project->supervisor && $chat->staff->StaffRef == $project->supervisor->StaffRef)
                      <i class="fa fa-shield m-l-5" data-toggle="tooltip" title="Supervisor" data-placement="right"></i>
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
            <div class="text-center text-uppercase text-muted">No Messages Yet</div>
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

{{-- Start Gantt --}}
<div class="card-box">
  <div id="gantt_chart"></div>
</div>
{{-- End Gantt --}}


  <!-- EDIT Modal -->
  <div class="modal fade slide-up disable-scroll" id="edit_project" role="dialog" aria-hidden="false">
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
  <div class="modal fade slide-up disable-scroll" id="user_tasks" tabindex="-1" role="dialog" aria-hidden="false">
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


  <link rel="stylesheet" href="{{ asset('assets/plugins/gantt/gantt.min.css') }}">
  <script src="{{ asset('assets/plugins/gantt/gantt_chart.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/plugins/gantt/plugins_gantt_chart.min.js') }}" charset="utf-8"></script>

  {{-- Start Gantt --}}
  <script>
    var ganttData = {!! $gantt !!};
    var ganttData2 = [
        {
            name: "Concept",
            series: [
                {
                    name: "Brainstorm",
                    sub_series: [
                        {
                            id: 1,
                            start: '08/01/2018',
                            end: '08/03/2018',
                            color: "#039BE5",
                            title: 'Custom title',
                            link: 'http://themeforest.com',
                            user_name: "Grayson Schmeler",
                            user_avatar: "assets/img/avatars/avatar_01_tn.png"
                        },
                        {
                            id: 2,
                            start: '08/05/2018',
                            end: '08/08/2018',
                            color: "#039BE5"
                        }
                    ]
                },
                {
                    name: "Wireframes",
                    sub_series: [
                        {
                            id: 3,
                            start: '08/04/2018',
                            end: '08/07/2018',
                            color: "#0288D1",
                            title: 'lorem ipsum dolor',
                            user_name: "Israel Rempel",
                            user_avatar: "assets/img/avatars/avatar_03_tn.png"
                        },
                        {
                            id: 4,
                            start: '08/10/2018',
                            end: '08/14/2018',
                            color: "#0288D1"
                        },
                        {
                            id: 5,
                            start: '08/18/2018',
                            end: '08/26/2018',
                            color: "#0277BD",
                            user_name: "Coty Rosenbaum",
                            user_avatar: "assets/img/avatars/avatar_06_tn.png"
                        }
                    ]
                },
                {
                    id: 6,
                    name: "Concept description",
                    start: '08/06/2018',
                    end: '08/10/2018',
                    color: "#0277BD"
                }
            ]
        },
        {
            name: "Design",
            series: [
                {
                    id: 7,
                    name: "Sketching",
                    start: '08/08/2018',
                    end: '08/16/2018',
                    color: "#673AB7"
                },
                {
                    id: 8,
                    name: "Photography",
                    start: '08/10/2018',
                    end: '08/16/2018',
                    color: "#5E35B1",
                    title: 'Some inspirations',
                    link: 'https://unsplash.com/',
                    user_name: "Jamarcus Block",
                    user_avatar: "assets/img/avatars/avatar_05_tn.png"
                },
                {
                    name: "Feedback",
                    sub_series: [
                        {
                            id: 9,
                            start: '08/19/2018',
                            end: '08/21/2018',
                            color: "#512DA8"
                        },
                        {
                            id: 10,
                            start: '08/24/2018',
                            end: '08/28/2018',
                            color: "#512DA8"
                        }
                    ]

                },
                {
                    id: 11,
                    name: "Final Design",
                    start: '08/21/2018',
                    end: '08/29/2018',
                    color: "#4527A0",
                    user_name: "Annetta Roberts",
                    user_avatar: "assets/img/avatars/avatar_02_tn.png"
                }
            ]
        },
        {
            name: "Implementation",
            series: [
                {
                    id: 12,
                    name: "Specifications",
                    start: '08/26/2018',
                    end: '09/06/2018',
                    color: "#8BC34A"
                },
                {
                    id: 13,
                    name: "Templates",
                    start: '09/04/2018',
                    end: '09/10/2018',
                    color: "#7CB342"
                },
                {
                    id: 14,
                    name: "Database",
                    start: '09/05/2018',
                    end: '09/13/2018',
                    color: "#689F38"
                },
                {
                    id: 15,
                    name: "Integration",
                    start: '09/16/2018',
                    end: '10/10/2018',
                    color: "#558B2F",
                    user_name: "Will Kemmer",
                    user_avatar: "assets/img/avatars/avatar_07_tn.png"
                }
            ]
        },
        {
            name: "Testing & Delivery",
            series: [
                {
                    id: 16,
                    name:   "Focus Group",
                    start:  '10/17/2018',
                    end:    '10/27/2018',
                    color:  "#F57C00"
                },
                {
                    name:   "Stress Test",
                    sub_series: [
                        {
                            id: 17,
                            start:  '10/25/2018',
                            end:    '11/06/2018',
                            color:  "#EF6C00"
                        },
                        {
                            id: 18,
                            start:  '11/09/2018',
                            end:    '11/12/2018',
                            color:  "#EF6C00"
                        }
                    ]
                },
                {
                    id: 19,
                    name:   "Delivery",
                    start:  '11/07/2018',
                    end:    '11/12/2018',
                    color:  "#E65100",
                    user_name: "Princess Schmidt",
                    user_avatar: "assets/img/avatars/avatar_06_tn.png"
                }
            ]
        }
    ];

    $(function() {
        altair_gantt.init()
    }), altair_gantt = {
        init: function() {
            var t = $("#gantt_chart");
            t.length && (t.ganttView({
                data: ganttData,
                startDate: "{{ Carbon::parse($project->StartDate)->format('m/d/Y') }}",
                endDate: "{{ Carbon::parse($project->EndDate)->format('m/d/Y') }}",
                behavior: {
                    onClick: function(t) {
                        console.log("You clicked on an event: \n", t)
                    },
                    onResize: function(t) {
                        console.log("You resized an event: \n", t)
                    },
                    onDrag: function(t) {
                        console.log("You dragged an event: \n", t)
                    }
                }
            }), t.find("[title]").each(function() {
                $(this).attr("data-uk-tooltip", "{offset:4}")
            }))
        }
    };
  </script>
  {{-- End Gantt --}}
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
