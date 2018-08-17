<div class="card-box">
  <h4 class="card-title"><b>Task Details</b></h4>

  <ul class="my-list">
      <li class="row card-list-item list-inline">
        <div class="col-md-6"><b>Task Title:</b></div> <span class="col-md-6">{{ $task->Task }}</span>
      </li>
      <li class="row card-list-item list-inline">
        <div class="col-md-6"><b>Assigned To:</b></div> <span class="col-md-6">{{ ($task->staff)? $task->staff->FullName : 'Unassigned' }}</span>
      </li>
      <li class="row card-list-item list-inline">
        <div class="col-md-6"><b>Due Date:</b></div> <span class="col-md-6">{{ ($task->EndDate)? Carbon::parse($task->EndDate)->format('jS M, Y') : '—' }}</span>
      </li>
      <li class="row card-list-item list-inline">
        <div class="col-md-6"><b>From Project:</b></div> <span class="col-md-6"><a href="{{ route('view_project', $task->ProjectID) }}">{{ $task->project->Project }}</a></span>
      </li>

      <li class="row card-list-item list-inline">
        <div class="col-md-6"><b>Progress:</b></div> <span class="col-md-6">
          <!-- Start Progress -->
              <div class="progress progress-striped active progress-lg m-b-0">
                <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $task->ProgressPercent }};">
                    {{ $task->ProgressPercent }}
                </div>
              </div>
          <!-- End Progress -->
        </span>
      </li>
  </ul>
</div>
