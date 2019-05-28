@extends('layouts.master')

@section('title')
  {{-- Task - {{ $task->Task }} --}}
@endsection

@section('page-title')
  Assigned To-Dos
@endsection

@section('buttons')
  {{-- <a class="btn btn-sm btn-info btn-rounded" href="{{ route('todos_calendar') }}"><i class="fa fa-calendar m-r-5"></i> Back to Calendar</a> --}}
  <a href="{{ route('todos') }}" class="btn btn-info btn-rounded">My To-Dos</a>
  <a class="btn btn-sm btn-info btn-rounded" href="{{ route('todos_calendar') }}"><i class="fa fa-calendar m-r-5"></i> My To-Dos Calendar</a>
  <a href="{{ route('unassigned_todos') }}" class="btn btn-info btn-rounded">Unassigned To-Dos</a>
  <button class="btn btn-info btn-rounded new_todo" data-toggle="modal" data-target="#new_todo">+ New To-Do</button>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card-box">
        <div class="card-title">Assignees <span class="badge badge-info badge-fix">{{ count($todo_users) }}</span></div>
        <ul class="my-list">
          @forelse ($todo_users as $tu)
            <li>
              <a onclick="get_todos('{{ $tu->id ?? '-' }}')" class="pointer">{{ $tu->FullName ?? '-' }}</a>
            </li>
          @empty
            @emptylist(You havent assigned todos to anyone.)
          @endforelse
        </ul>

      </div>
    </div>

    <div class="col-md-8">
      {{-- START TABS --}}
      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#undone">To-Dos</a></li>
        <li><a data-toggle="tab" href="#done">Done</a></li>
      </ul>
      <div class="tab-content">
        <div id="undone" class="tab-pane fade in active">

          <div class="card-box">
            <div id="todos-title" class="card-title"></div>
            {{-- <p></p> --}}
            <form action="" method="GET" onsubmit="" id="filter_undone">
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

            <ul id="todos" class="my-list">
              @emptylist(No user selected)
            </ul>
          </div>

        </div>
        <div id="done" class="tab-pane fade">

          <div class="card-box">
            {{-- <div id="todos-title" class="card-title"></div> --}}

            <form action="" method="GET" onsubmit="" id="filter_done">
              <div class="row m-b-20" style="width:80%; margin:0 auto 20px auto">
                <div class="col-md-4">
                  <div class="form-group">
                    {{-- <label>From</label> --}}
                    <div class="input-group date dp">
                      <input type="text" name="from" class="form-control" value="" placeholder="From Completed Date" required>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    {{-- <label>To</label> --}}
                    <div class="input-group date dp">
                      <input type="text" name="to" class="form-control" value="" placeholder="To Completed Date" required>
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

            <ul id="todos-done" class="my-list">
              @emptylist(No user selected)
            </ul>
          </div>

        </div>
      </div>
      {{-- END TABS --}}

    </div>
  </div>


  @include('todos.add_edit_modal')


@endsection


@push('scripts')
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script>
    function get_todos(id) {
      $('#spinner').show();

      $.get('/get_assigned_todos/'+id, function(data, status){
        $('#todos').empty();
        console.log(data);
        // $.each(data, function(index, todo){
        //   console.log(todo);
        // });
        data.todos.forEach(function(todo){
          $('#todos').append(`

            <li style="position:relative">
              <div class="checkbox checkbox-info inline-block m-0" style="width:100%">

                <input type="checkbox" name="" value="" onclick="toggle_step(${todo.TodoRef})" autocomplete="off" id="step_id_${ todo.TodoRef }" ${ (todo.Done == true)? 'checked' : '' }>

                <label for="step_id_${ todo.TodoRef }" class="${ (todo.Done == true)? 'strike':'' }">${ todo.Todo }</label>

                <div class="step-actions inline-block text-right pointer" style="position:absolute;top:5px;right:10px">
                  <a data-toggle="modal" data-target="#edit_todo" onclick="edit_data('${todo.TodoRef}')"><i class="fa fa-pencil text-warning"></i></a>
                </div>

                <div class="small text-muted p-l-5 m-t-5">
                  Due: <span class="">${ (todo.DueDate)? moment(todo.DueDate).format('Do MMM, YYYY') : '—' }</span>
                </div>

              </div>
            </li>
          `);
        });
        $('#todos-title').html(data.todo_user.first_name+' '+data.todo_user.last_name+'\'s To-Dos<br><p class="text-muted" style="text-transform:initial">A list of to-dos you have assigned to this person.</p>');
        $('#spinner').hide();
      });

      $.get('/get_assigned_todos_done/'+id, function(data, status){
        $('#todos-done').empty();
        console.log(data);
        // $.each(data, function(index, todo){
        //   console.log(todo);
        // });
        data.forEach(function(todo){
          $('#todos-done').append(`
            <li>
              <div class="checkbox checkbox-info inline-block m-0" style="width:100%">

                <input type="checkbox" name="" value="" onclick="toggle_step(${todo.TodoRef})" autocomplete="off" id="step_id_${ todo.TodoRef }" ${ (todo.Done)? 'checked' : '' }>

                <label for="step_id_${ todo.TodoRef }" class="${ (todo.Done)? 'strike':'' }">${ todo.Todo }</label>

                <div class="step-actions inline-block text-right pointer" style="position:absolute;top:5px;right:10px">
                  <a data-toggle="modal" data-target="#edit_todo" onclick="edit_data('${todo.TodoRef}')"><i class="fa fa-pencil text-warning"></i></a>
                </div>

                <div class="small text-muted">
                  completed: <span class="text-success">${ (todo.CompletedDate)? moment(todo.CompletedDate).format('Do MMM, YYYY') : '—' }</span>
                </div>

              </div>
            </li>


          `);
          // <li style="position:relative">
          //   <div class="f15"><s>${todo.Todo}</s></div>
          // </li>
          // $('#todos-title').html(todo.user.first_name+' '+todo.user.last_name+'\'s To-Dos<br><p class="text-muted" style="text-transform:initial">A list of to-dos you have assigned to this person.</p>');
        });
        $('#filter_done').attr('onsubmit', 'filter_done('+id+'); return false;');
        $('#filter_undone').attr('onsubmit', 'filter_undone('+id+'); return false;');
        $('#spinner').hide();
      });

    }

    function filter_done(id) {
      let from = $('#filter_done input[name=from]').val();
      let to = $('#filter_done input[name=to]').val();
      console.log(from+' '+to);
      $.get('/get_assigned_todos_done/'+id+'?from='+from+'&to='+to, function(data, status){
        $('#todos-done').empty();

        data.forEach(function(todo){
          $('#todos-done').append(`
            <li>
              <div class="checkbox checkbox-info inline-block m-0" style="width:100%">

                <input type="checkbox" name="" value="" onclick="toggle_step(${todo.TodoRef})" autocomplete="off" id="step_id_${ todo.TodoRef }" ${ (todo.Done)? 'checked' : '' }>

                <label for="step_id_${ todo.TodoRef }" class="${ (todo.Done)? 'strike':'' }">${ todo.Todo }</label>

                <div class="step-actions inline-block text-right pointer" style="position:absolute;top:5px;right:10px">
                  <a data-toggle="modal" data-target="#edit_todo" onclick="edit_data(['${todo.TodoRef}', '${todo.Todo}', [${todo.assignees.map(a => a.id)}], '${todo.DueDate}'])"><i class="fa fa-pencil text-warning"></i></a>
                </div>

                <div class="small text-muted">
                  completed: <span class="text-success">${ (todo.CompletedDate)? moment(todo.CompletedDate).format('Do MMM, YYYY') : '—' }</span>
                </div>

              </div>
            </li>
          `);

        });
        // $('#filter_done').attr('onsubmit', 'filter_done('+id+'); return false;');
        // $('#spinner').hide();
      });
    }

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



    //
    // function edit_data(data) {
    //   // console.log(data);
    //   $('#edit_todo').find('input[name=Todo]').val(data[1]);
    //   $('#edit_todo').find('select[name=UserID]').val(data[2]).trigger('change');
    //   $('#edit_todo').find('input[name=DueDate]').val(data[3]);
    //   $('#edit_todo').find('form').attr('action', '/update_todo/'+data[0]);
    // }

    function toggle_step(id) {
      var base = '{{ url('/') }}';
      $.get(base+'/toggle_todo/'+id+'?checkonly=true', function(data, status){
        if (data.Done == '1') {
          $('#step_id_'+id).closest('div').find('label').addClass('strike');
        } else {
          $('#step_id_'+id).closest('div').find('label').removeClass('strike');
        }
      });
    }
  </script>
@endpush
