
<div class="my-list">
  @foreach ($staff->projects as $project)
    <li class="row f16">
      <div class="col-md-1">
        <i class="fa fa-plus-circle f20 text-success pointer toggle_{{ $project->ProjectRef }}" onclick="toggle_project('{{ $project->ProjectRef }}')"></i>
      </div>
      <div class="col-md-6">
        {{ $project->Project }}
      </div>
      <div class="col-md-5 f20 text-right">
        {{ $project->ProgressPercent }}
      </div>
    </li>
    <div id="project_{{ $project->ProjectRef }}" style="display:none;">
      @foreach ($project->tasks->where('StaffID', $staff->StaffRef) as $task)
        <li class="row p-t-10 p-b-10" style="background: lightgoldenrodyellow">
          <div class="col-md-1">
          </div>
          <div class="col-md-4">
            <a href="{{ route('view_task', $task->TaskRef) }}">{{ $task->Task }}</a>
          </div>
          <div class="col-md-5">
            @if (count($task->updates) > 0)
              {{ $task->updates->take('1')->first()->Body }}
              <span class="text-muted small">&mdash; {{ $task->updates->take('1')->first()->staff->FullName }}</span>
            @else &mdash; @endif
          </div>
          <div class="col-md-2">

            <div class="small clearfix">
              {{-- Progress count --}}
              <span class="pull-right text-success">{{ ($task->progress != 100)? $task->progress_percent : 'Done' }}</span>
              {{-- End progress count --}}
            </div>
            <div class="progress progress-striped active progress-sm m-b-0">
              <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $task->progress_percent }}">
                <span class="sr-only">{{ $task->progress_percent }} Complete</span>
              </div>
            </div>

          </div>
        </li>
      @endforeach
    </div>
  @endforeach
</div>



@push('scripts')
  <script>
    function toggle_project(id) {
      $('div#project_'+id).toggle();
      $('.toggle_'+id).toggleClass('fa fa-plus-circle text-success').toggleClass('fa fa-minus-circle text-danger');
    }
  </script>
@endpush
