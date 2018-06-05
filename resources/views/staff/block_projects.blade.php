{{-- Start Projects --}}
<div class="row">
  <div class="col-md-12">

    <ul class="cd-accordion-menu animated">
      @foreach ($staff->projects_extended as $project)
        <li class="has-children">
          <input type="checkbox" name ="project_{{ $project->ProjectRef }}" id="project_{{ $project->ProjectRef }}">
          <label for="project_{{ $project->ProjectRef }}">
            {{ $project->Project }}
            {{-- Start Project Progress --}}
            <div class="progress m-t-10">
              <div class="progress progress-striped active progress-md m-b-0">
                  <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $project->progress_percent }};">
                    {{ $project->progress_percent }}
                  </div>
              </div>
            </div>
            {{-- End Project Progress --}}
          </label>
          <ul>
            @foreach ($project->tasks->where('StaffID', $staff->StaffRef) as $task)
              <li class="has-children">
                <input type="checkbox" name ="task_{{ $task->TaskRef }}" id="task_{{ $task->TaskRef }}">
                <label for="task_{{ $task->TaskRef }}">
                  {{ $task->Task }}
                    {{-- Circle Progress count --}}
                    <div class="ldBar label-center" data-value="{{ $task->progress }}" data-preset="circle" data-stroke="#39b54a" data-stroke-trail="#777" data-stroke-width="5" data-stroke-trail-width="1"></div>
                    {{-- End Circle progress count --}}
                </label>
                <ul>
                  {{-- <i class="fa {{ ($step->Done)? 'fa-check text-success' : 'fa-ellipsis-h text-inverse' }} m-r-5"></i> --}}
                  @foreach ($task->steps as $step)
                    <li><a href="#0" style="{{ ($step->Done)? 'text-decoration:line-through;color:#777' : '' }}">{{ $step->Step }}</a></li>
                  @endforeach
                </ul>
              </li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>

  </div>
</div>
{{-- End Projects --}}
