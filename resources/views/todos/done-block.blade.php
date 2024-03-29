<div class="card-box steps_div">
  <h4 class="card-title"><b>Done Items {!! (!empty($date))? '— <span class="text-muted">'.$date.'</span>' : '' !!}</b>
    {{-- <span class="pull-right text-lowercase f13">{{ count($task->StepsUndone) }} of {{ count($task->steps) }} remaining</span> --}}
    {{-- <button class="btn btn-info btn-rounded pull-right" data-toggle="modal" data-target="#new_todo" style="margin-top:-10px">+ Add Item</button> --}}
  </h4>
  {{-- <ul class="my-list" id="steps_list" data-task_id="{{ $task->TaskRef }}"> --}}
  <ul class="my-list">
    @forelse($dones as $done)
    <li>
      <div class="checkbox checkbox-info inline-block" style="width:80%">

        <input type="checkbox" name="" value="" onclick="toggle_step({{ $done->TodoRef }})" autocomplete="off" id="step_id_{{ $done->TodoRef }}" {{ ($done->Done)? 'checked' : '' }}>

        <label for="step_id_{{ $done->TodoRef }}" class="{{ ($done->Done)? 'strike':'' }}">{{ $done->Todo }}</label>

        @if ($done->DueDate)
          <div class="small text-muted p-l-25">
            {{ ($done->DueDate)? Carbon::parse($done->DueDate)->format('jS M, Y') : '—' }}
          </div>
        @endif
      </div>


      @if ($user->id == $done->Initiator)

        <div class="step-actions inline-block text-right" style="width:18%">
          <a href="#edit_step{{ $done->TodoRef }}" data-toggle="collapse" aria-expanded="false" class="collapsed"><i class="fa fa-pencil text-warning"></i></a>
          <a href="#" onclick="confirm2('Delete this To-Do?', '', 'delete_{{ $done->TodoRef }}')"><i class="fa fa-trash-o text-danger m-l-5"></i></a>
          <form id="delete_{{ $done->TodoRef }}" class="hidden" action="{{ route('delete_todo', $done->TodoRef) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
          </form>
        </div>

        <div class="m-l-15 p-r-0 panel-collapse collapse m-b-15" id="edit_step{{ $done->TodoRef }}">
          <form action="{{ route('update_todo', $done->TodoRef) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {{-- {{ Form::label('Todo', 'Todo Item' ) }} --}}
                  {{ Form::text('Todo', $done->Todo, ['class' => 'form-control input-sm', 'placeholder' => 'Enter todo', 'required']) }}
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  {{-- {{ Form::label('DueDate', 'Due Date' ) }} --}}
                  <div class="input-group date dp">
                    {{ Form::text('DueDate', $done->DueDate, ['class' => 'form-control input-sm', 'placeholder' => 'Due Date', 'required']) }}
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
          From: <span class="text-black m-l-5">{{ $done->initiator->FullName }}</span>
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
