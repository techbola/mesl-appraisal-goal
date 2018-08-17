@extends('layouts.master')

@section('title')
  Task - {{ $task->Task }}
@endsection

@section('page-title')
  <span class="text-muted">Task:</span> <b>{{ $task->Task }}</b>
@endsection

@section('buttons')
  <a href="{{ route('view_project', $task->ProjectID) }}" class="btn btn-sm btn-info btn-rounded"><i class="fa fa-arrow-left m-r-5"></i>Back to Project</a>
  <a class="btn btn-sm btn-info btn-rounded m-l-10" data-toggle="modal" data-target="#edit_task"><i class="fa fa-pencil m-r-5"></i>Edit Task</a>
  <a href="" class="btn btn-sm btn-danger btn-rounded m-l-10" onclick="return confirm('Are you sure you want to delete this task?')"><i class="fa fa-trash m-r-5"></i>Delete</a>
@endsection

@section('content')
  <style>
    .step-actions {
      vertical-align: top;
      margin-top: 15px;
    }
    .strike {
      text-decoration: line-through;
    }
  </style>
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

              <label for="step_id_{{ $step->StepRef }}" class="{{ ($step->Done)? 'strike':'' }}">{{ $step->Step }}</label>

              @if ($step->StartDate || $step->EndDate)
                <div class="small text-muted p-l-25">
                  {{ Carbon::parse($step->StartDate)->format('jS M, Y') }} — {{ Carbon::parse($step->EndDate)->format('jS M, Y') }}
                </div>
              @endif
              <div class="small text-success p-l-25 CompletedDate">
                @if ($step->CompletedDate && $step->Done)
                  Completed: <span class="date">{{ Carbon::parse($step->CompletedDate)->format('jS M, Y') }}</span>
                @endif
              </div>
              <div class="clearfix"></div>

            </div>


            <div class="step-actions inline-block text-right" style="width:18%">
              <a href="#edit_step{{ $step->StepRef }}" data-toggle="collapse" aria-expanded="false" class="collapsed"><i class="fa fa-pencil text-warning"></i></a>
              <a href="#" onclick="confirm2('Delete this step?', '', 'delete_{{ $step->StepRef }}')"><i class="fa fa-trash-o text-danger m-l-5"></i></a>
              <form id="delete_{{ $step->StepRef }}" class="hidden" action="{{ route('delete_step', $step->StepRef) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
            </div>

            <div class="m-l-15 p-r-0 panel-collapse collapse m-b-15" id="edit_step{{ $step->StepRef }}">
              <form action="{{ route('edit_step', $step->StepRef) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="input-group hidden">
                  <input type="text" class="form-control input-sm" name="Step" value="{{ $step->Step }}">
                  <span class="input-group-btn">
                    <input type="submit" class="btn btn-sm btn-info" value="Save">
                  </span>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" name="Step" class="form-control input-sm" value="{{ $step->Step }}" placeholder="Edit Step" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group date dp">
                        {{ Form::text('StartDate', $step->StartDate, ['class' => 'form-control input-sm', 'placeholder' => 'Start Date', 'required']) }}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {{-- {{ Form::label('EndDate', 'End Date' ) }} --}}
                      <div class="input-group date dp">
                        {{ Form::text('EndDate', $step->EndDate, ['class' => 'form-control input-sm', 'placeholder' => 'End Date', 'required']) }}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      @if (!empty($step->last_update) && $step->last_update->Status == NULL)
                        <label class="f13">Budget Cost</label>
                        <input type="text" class="form-control input-sm" value="" placeholder="Pending Review / {{ nairazify(number_format($step->last_update->BudgetCost)) }}" disabled>
                      @elseif (!empty($step->last_update) && $step->last_update->Status == '1')
                        <label class="f13">Budget Cost</label>
                        <input type="text" class="form-control input-sm" value="" placeholder="Approved / {{ nairazify(number_format($step->last_update->BudgetCost)) }}" disabled>
                      @elseif (!empty($step->last_update) && $step->last_update->Status == '0')
                        <label class="f13">Budget Cost</label>
                        {{ Form::text('BudgetCost', $step->BudgetCost, ['class' => 'form-control smartinput', 'placeholder' => 'BudgetCost']) }}
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12 p-l-10">
                    <input type="submit" class="btn btn-sm btn-info" value="Save">
                    <a class="btn btn-sm btn-inverse m-l-10" href="#edit_step{{ $step->StepRef }}" data-toggle="collapse">Cancel</a>
                  </div>
                </div>
                <hr>
              </form>
            </div>
          </li>

          @endforeach
        </ul>

        <form action="{{ route('add_step', $task->TaskRef) }}" method="post" style="background:#f8f8f8; padding:10px 5px; border-radius:8px">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="Step" class="form-control" value="" placeholder="Add New Step" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{-- {{ Form::label('StartDate', 'Start Date' ) }} --}}
                <div class="input-group date dp">
                  {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{-- {{ Form::label('EndDate', 'End Date' ) }} --}}
                <div class="input-group date dp">
                  {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required']) }}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                {{-- {{ Form::label('EndDate', 'End Date' ) }} --}}
                {{ Form::text('BudgetCost', null, ['class' => 'form-control smartinput', 'placeholder' => 'BudgetCost']) }}
              </div>
            </div>
            <div class="col-md-12 p-l-0">
              <input type="submit" class="btn btn-info btn-block" value="Add Step">
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Start Task Details -->

      <div class="col-md-6">


        {{-- START TABS --}}
        <ul class="nav nav-tabs outside">
          <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
          <li><a data-toggle="tab" href="#updates">Updates <span class="badge badge-info badge-sm badge-tab">0</span></a></li>
        </ul>
        <div class="tab-content">
          <div id="details" class="tab-pane fade in active">

            @include('tasks.details')

          </div>
          <div id="updates" class="tab-pane fade">

            @include('tasks.updates')

          </div>
        </div>
        {{-- END TABS --}}

      </div>
    <!-- End Task Details -->

  </div>



  {{-- Start Edit Modal --}}
  <div class="modal fade disable-scroll" id="edit_task" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit Task</h5>
          </div>
          <div class="modal-body">
            {{ Form::model($task, ['route' => ['update_task', $task->TaskRef ], 'class' => 'm-t-15']) }}
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="form-group">
                {{ Form::label('Title') }}
                {{ Form::text('Task', null, ['class' => 'form-control', 'placeholder' => 'Enter Task Title', 'required']) }}
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('Assign To') }}
                    {{ Form::select('StaffID', [''=>'Assign To...'] + $staffs->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "select2 full-width",'data-placeholder' => "Assign this task to...", 'data-init-plugin' => "select2", 'required']) }}
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('EndDate', 'Due Date' ) }}
                    <div class="input-group date dp">
                      {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>

              {{-- <div class="clearfix">
                <input type="submit" name="add_task" class="btn btn-success col-sm-5" value="Save">
                <a href="#add_task" class="btn btn-inverse col-sm-5 col-sm-offset-2" data-toggle="collapse" class="collapsed">Cancel</a>
              </div> --}}

            {{-- </form> --}}

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  {{-- End Edit Modal --}}
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
      console.log(data.task.progress_percent);
      // reload_steps();

      if (data.Done == '1') {
        $('#step_id_'+id).closest('li').find('.CompletedDate').html(`
          Completed: ${moment(data.CompletedDate).format('Do MMM, YYYY')}
        `);
        $('#step_id_'+id).closest('div').find('label').addClass('strike');
      } else {
        $('#step_id_'+id).closest('li').find('.CompletedDate').empty();
        $('#step_id_'+id).closest('div').find('label').removeClass('strike');
      }

      $('.progress-bar').css({"width": data.task.progress_percent});
      $('.progress-bar').text(data.task.progress_percent);
    });

  }
  </script>
@endpush
