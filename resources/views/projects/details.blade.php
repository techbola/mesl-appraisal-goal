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



<div class="row">
  <div class="col-md-4">
    <div class="card-box">
      <h4 class="card-title">Project Tasks <span class="badge badge-inverse badge-sm m-l-5">{{ count($project->tasks) }}</span></h4>

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
      <h4 class="card-title"><b>Assignees</b> <span class="badge badge-inverse badge-sm m-l-5">{{ count($project->assignees) }}</span></h4>

      <div class="my-list{{ (count($project->assignees) > 6)? ' nicescroll mx-box':'' }}">

        @foreach ($project->assignees as $staff)
        {{-- @foreach ($project->tasks as $task) --}}
          <li>
            <ul class="list-inline">
                <li style="border-bottom: none;"><img src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" class="img-circle thumb-40" alt=""></li>
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
      <div class="inbox-widget<?php if(count($project->chats) > 6){ echo ' nicescroll mx-box'; } ?>" style="overflow-y: auto;max-height: 300px;">

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
