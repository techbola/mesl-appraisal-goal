@extends('layouts.master')

@section('title')
  Task - {{ $task->Task }}
@endsection

@section('page-title')
  <span class="text-muted">Task:</span> <b>{{ $task->Task }}</b>
@endsection

@section('buttons')
  <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_task"><i class="fa fa-pencil m-r-5"></i>Edit Task</a>
  <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this task?')"><i class="fa fa-trash m-r-5"></i>Delete</a>
@endsection

@section('content')
  <!-- Page-Title -->
  {{-- <div class="row m-b-15">
    <div class="col-sm-12 clearfix">
      <h4 class="page-title pull-left">
        <span class="text-muted font-title">Task:</span> {{ $task->Task }}
      </h4>

      <div class="pull-right">
        <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_task"><i class="fa fa-pencil m-r-5"></i>Edit Task</a>
        <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this task?')"><i class="fa fa-trash m-r-5"></i>Delete</a>
      </div>
    </div>
  </div> --}}
  <!-- End Page Title -->

  <div class="row">
    <div class="col-md-6">

      <div class="card-box steps_div">
        <h4 class="card-title"><b>Steps</b> <span class="pull-right text-lowercase f13">{{ count($task->StepsUndone) }} of {{ count($task->steps) }} remaining</span></h4>
        <ul class="my-list" id="steps_list" data-task_id="{{ $task->TaskRef }}">
          @foreach($task->steps as $step)
          <li>
            <div class="checkbox checkbox-info inline-block" style="width:80%">

              <input type="checkbox" name="" value="" onclick="toggle_step({{ $step->StepRef }})" autocomplete="off" id="step_id_{{ $step->StepRef }}" data-step_id="{{ $step->StepRef }}" {{ ($step->Done)? 'checked' : '' }}

              {{ ( $user->staff && $user->staff->StaffRef != $task->StaffID && !$user->hasRole('admin') )? 'disabled' : '' }}
              >

              <label for="step_id_{{ $step->StepRef }}" style="{{ ($step->Done)? 'text-decoration:line-through;':'' }}">{{ $step->Step }}</label>
            </div>


            <div class="inline-block text-right" style="width:18%">
              <a href="#edit_step{{ $step->StepRef }}" data-toggle="collapse" aria-expanded="false" class="collapsed"><i class="fa fa-pencil text-warning"></i></a>
              <a href="/steps/delete/{{ $step->StepRef }}" onclick="return confirm('Are you sure you want to delete this step?')"><i class="fa fa-trash-o text-danger m-l-5"></i></a>
            </div>
            <div class="m-l-15 p-r-0 panel-collapse collapse m-b-15" id="edit_step{{ $step->StepRef }}">
              <form action="{{ route('edit_step', $step->StepRef) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="input-group">
                  <input type="text" class="form-control input-sm" name="Step" value="{{ $step->Step }}">
                  <span class="input-group-btn">
                    <input type="submit" name="edit_step" class="btn btn-sm btn-info" value="Save">
                  </span>
                </div>
              </form>
            </div>
          </li>

          @endforeach
        </ul>

        <form action="{{ route('add_step', $task->TaskRef) }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <input type="text" name="Step" class="form-control" value="" placeholder="Add New Step" required>
              </div>
            </div>
            <div class="col-md-3 p-l-0">
              {{-- <input type="hidden" name="task_id" value="{{ $task->Task }}"> --}}
              <input type="submit" class="btn btn-info btn-block" value="Add Step">
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Start Task Details -->

      <div class="col-md-6">

        <div class="card-box">
          <h4 class="card-title"><b>Task Details</b></h4>

          <ul class="my-list">
              <li class="row card-list-item list-inline">
                <div class="col-md-6"><b>From Project:</b></div> <span class="col-md-6"><a href="{{ route('view_project', $task->ProjectID) }}">{{ $task->project->Project }}</a></span>
              </li>
              <li class="row card-list-item list-inline">
                <div class="col-md-6"><b>Assigned To:</b></div> <span class="col-md-6">{{ ($task->staff)? $task->staff->FullName : 'Unassigned' }}</span>
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

      </div>
    <!-- End Task Details -->

  </div>
@endsection

@push('scripts')
  <script>
  function reload_steps() {
    location.reload();
    // $("#steps_div").load(location.href+" #steps_div>*","");
    // $("#steps_div").hide().fadeIn('fast');
  }

  function toggle_step(id) {
    var base = '{{ url('/') }}';
    $.get(base+'/toggle_step/'+id, function(data, status){
      console.log(data);
      reload_steps();
    });

  }


  </script>
@endpush
