<div class="card-box steps_div">
  <h4 class="card-title"><b>To-Do Items {!! (!empty($date))? '— <span class="text-muted">'.$date.'</span>' : '' !!}</b>

    
    {{-- <span class="pull-right text-lowercase f13">{{ count($task->StepsUndone) }} of {{ count($task->steps) }} remaining</span> --}}
    
    <button class="btn btn-sm btn-info btn-rounded pull-right" data-toggle="modal" data-target="#new_todo" style="margin-top:-10px">+ Add Item</button>
  </h4>
  <div class="clearfix"></div>

  <form action="" method="GET" onsubmit="filter_undone('{{ auth()->user()->id }}'); return false;" id="filter_undone">
    <div class="row m-b-20" style="width:80%; margin:0 auto 20px auto">
      <div class="col-md-4">
        <div class="form-group">
          {{-- <label>From</label> --}}
          <div class="input-group date dp">
            <input type="text" name="from" class="form-control" value="" placeholder="From Due Date" required>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          {{-- <label>To</label> --}}
          <div class="input-group date dp">
            <input type="text" name="to" class="form-control" value="" placeholder="To Due Date" required>
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <label></label>
        <button type="submit" class="btn btn-info">Fetch</button>
        {{-- <a class="btn btn-inverse m-t-25 btn-cons" onclick="document.getElementById('filter_done').reset()">Reset</a> --}}
      </div>
    </div>
  </form>
  {{-- <ul class="my-list" id="steps_list" data-task_id="{{ $task->TaskRef }}"> --}}
  <ul class="my-list" id="todos">
    @forelse($todos as $todo)
    <li>
      <div class="checkbox checkbox-info inline-block" style="width:75%">

        <input type="checkbox" name="" value="" onclick="toggle_step({{ $todo->TodoRef }})" autocomplete="off" id="step_id_{{ $todo->TodoRef }}" {{ ($todo->Done)? 'checked' : '' }}>

        <label for="step_id_{{ $todo->TodoRef }}" class="{{ ($todo->Done)? 'strike':'' }}">{{ $todo->Todo }}</label>

        @if ($todo->DueDate)
          <div class="small text-muted p-l-5">
            <i class="fa fa-calendar m-r-5"></i>
            {{ ($todo->DueDate)? Carbon::parse($todo->DueDate)->format('jS M, Y') : '—' }}
            <i class="fa fa-clock-o m-l-5 m-r-5"></i>
            {{ ($todo->StartTime)? Carbon::parse($todo->StartTime)->format('g:iA') : '' }} - {{ ($todo->EndTime)? Carbon::parse($todo->EndTime)->format('g:iA') : '' }}
          </div>
        @endif
      </div>

      @if ($user->id == $todo->Initiator)
        <div class="step-actions inline-block text-right" style="width:23%">
          {{-- <a href="#edit_step{{ $todo->TodoRef }}" data-toggle="collapse" aria-expanded="false" class="collapsed"><i class="fa fa-pencil text-warning"></i></a> --}}
          <a class="pointer" data-toggle="modal" data-target="#edit_todo" onclick="edit_data('{{ $todo->TodoRef }}')"><i class="fa fa-pencil text-warning"></i></a>
          <a href="#" onclick="confirm2('Delete this To-Do?', '', 'delete_{{ $todo->TodoRef }}')"><i class="fa fa-trash-o text-danger m-l-5 "></i></a>
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
          From: <span class="text-black m-l-5">{{ $todo->initiator->FullName ?? '-' }}</span>
          <br>
          <a class="pointer" data-toggle="modal" data-target="#edit_todo" onclick="edit_data('{{ $todo->TodoRef }}')"><i class="fa fa-pencil text-warning"></i></a>
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
      @endif

    </li>
    @empty
      <div class="text-muted text-uppercase text-center m-t-10">
        No To-Do Items
      </div>
    @endforelse
  </ul>

</div>

@push('scripts')
<script>
    function filter_undone(id) {
      let from = $('#filter_undone input[name=from]').val();
      let to = $('#filter_undone input[name=to]').val();
      console.log(from+' '+to);
      
      $.get('/get_assigned_todos/'+id+'?from='+from+'&to='+to, function(data, status){
        $('#todos').empty();

        console.log(data);
        data.todos.forEach(function(todo){
          $('#todos').append(`
            <li>
              <div class="checkbox checkbox-info inline-block m-0" style="width:100%">

                <input type="checkbox" name="" value="" onclick="toggle_step(${todo.TodoRef})" autocomplete="off" id="step_id_${ todo.TodoRef }" ${ (todo.Done == true)? 'checked' : '' }>

                <label for="step_id_${ todo.TodoRef }" class="${ (todo.Done == true)? 'strike':'' }">${ todo.Todo }</label>

                <div class="step-actions inline-block text-right pointer" style="position:absolute;top:5px;right:10px">
                  <a data-toggle="modal" data-target="#edit_todo" onclick="edit_data(['${todo.TodoRef}', '${todo.Todo}', [${todo.assignees.map(a => a.id)}], '${todo.DueDate}'])"><i class="fa fa-pencil text-warning"></i></a>
                </div>

                <div class="small text-muted">
                  Due: <span class="text-muted">${ (todo.DueDate)? moment(todo.DueDate).format('Do MMM, YYYY') : '—' }</span>
                </div>

              </div>
            </li>
          `);

        });
        // $('#filter_done').attr('onsubmit', 'filter_done('+id+'); return false;');
        // $('#spinner').hide();
      });
    }
</script>
@endpush
