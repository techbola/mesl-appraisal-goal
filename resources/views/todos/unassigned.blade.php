@extends('layouts.master')

@section('title')
  {{-- Task - {{ $task->Task }} --}}
@endsection

@section('page-title')
  Unassigned To-Dos
@endsection

@section('buttons')

  <a class="btn btn-sm btn-info btn-rounded" href="{{ route('todos_calendar') }}"><i class="fa fa-calendar m-r-5"></i> Back to Calendar</a>
  <a href="{{ route('assigned_todos') }}" class="btn btn-info btn-rounded">Assigned To-Dos</a>
  <a href="{{ route('todos') }}" class="btn btn-info btn-rounded">My To-Dos</a>
  {{-- <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this task?')"><i class="fa fa-trash m-r-5"></i>Delete</a> --}}
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


  <div class="row">
    <div class="col-md-7">
      {{-- <div class="card-box">
        @include('todos.form')
      </div> --}}

      <div class="card-box steps_div">
        <h4 class="card-title"><b>Unassigned To-Dos {!! (!empty($date))? '— <span class="text-muted">'.$date.'</span>' : '' !!}</b>
          {{-- <span class="pull-right text-lowercase f13">{{ count($task->StepsUndone) }} of {{ count($task->steps) }} remaining</span> --}}

          <button class="btn btn-sm btn-info btn-rounded pull-right" data-toggle="modal" data-target="#new_todo" style="margin-top:-10px">+ Add Item</button>
        </h4>
        {{-- <ul class="my-list" id="steps_list" data-task_id="{{ $task->TaskRef }}"> --}}
        <ul class="my-list">
          @forelse($todos as $todo)
          <li>
            <div class="checkbox checkbox-info inline-block" style="width:75%">

              <input type="checkbox" name="" value="" onclick="toggle_step({{ $todo->TodoRef }})" autocomplete="off" id="step_id_{{ $todo->TodoRef }}" {{ ($todo->Done)? 'checked' : '' }}>

              <label for="step_id_{{ $todo->TodoRef }}" class="{{ ($todo->Done)? 'strike':'' }}">{{ $todo->Todo }}</label>

              @if ($todo->DueDate)
                <div class="small text-muted p-l-25">
                  {{ ($todo->DueDate)? Carbon::parse($todo->DueDate)->format('jS M, Y') : '—' }}
                </div>
              @endif
            </div>

            @if ($user->id == $todo->Initiator)
              <div class="step-actions inline-block text-right" style="width:23%">
                <a href="#edit_step{{ $todo->TodoRef }}" data-toggle="collapse" aria-expanded="false" class="collapsed"><i class="fa fa-pencil text-warning"></i></a>
                <a href="#" onclick="confirm2('Delete this To-Do?', '', 'delete_{{ $todo->TodoRef }}')"><i class="fa fa-trash-o text-danger m-l-5"></i></a>
                <form id="delete_{{ $todo->TodoRef }}" class="hidden" action="{{ route('delete_todo', $todo->TodoRef) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                </form>
              </div>

              <div class="m-l-15 p-r-0 panel-collapse collapse m-b-15" id="edit_step{{ $todo->TodoRef }}">
                <form action="{{ route('update_todo', $todo->TodoRef) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="row">
                    <div class="col-md-10">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            {{-- {{ Form::label('Todo', 'Todo Item' ) }} --}}
                            {{ Form::text('Todo', $todo->Todo, ['class' => 'form-control input-sm', 'placeholder' => 'Enter todo', 'required']) }}
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            {{-- {{ Form::label('DueDate', 'Due Date' ) }} --}}
                            <div class="input-group date dp">
                              {{ Form::text('DueDate', $todo->DueDate, ['class' => 'form-control input-sm', 'placeholder' => 'Due Date', 'required']) }}
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            {{-- <span class="help">Leave empty to assign to yourself.</span> --}}
                            {{ Form::select('UserID', [ '' =>  'Select Staff'] + $staffs->pluck('FullName', 'UserID')->toArray(), $todo->UserID, ['class'=> "form-control input-sm select2", 'data-init-plugin' => "select2"]) }}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                  </div>

                </form>
              </div>
            @else
              <div class="inline-block text-right small m-t-10 text-muted" style="width:23%; vertical-align: top;">
                {{-- From <span class="label label-inverse m-t-10">{{ $todo->initiator->FullName }}</span> --}}
                From: <span class="text-black m-l-5">{{ $todo->initiator->FullName }}</span>
              </div>
            @endif

          </li>
          @empty
            <div class="text-muted text-uppercase text-center m-t-10">
              No To-Do Items
            </div>
          @endforelse
        </ul>

      </div>


    </div>


  </div>



  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_todo" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Add New To-Do</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('save_todo') }}" method="post">
              {{ csrf_field() }}
              @include('todos.form')

            </form>
          </div>
        </div>
      </div>
    </div>
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
    $.get(base+'/toggle_todo/'+id, function(data, status){
      console.log(data);
      // reload_steps();

      $('#step_id_'+id).closest('div').find('label').toggleClass('strike');
      // $('.progress-bar').css({"width": data});
      // $('.progress-bar').text(data);
    });

  }
  </script>
@endpush
