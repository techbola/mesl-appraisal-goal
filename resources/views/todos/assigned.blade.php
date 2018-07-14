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
  <button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_todo">+ New To-Do</button>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card-box">
        <div class="card-title">Assignees <span class="badge badge-info badge-fix">{{ count($todo_users) }}</span></div>
        <ul class="my-list">
          @forelse ($todo_users as $tu)
            <li>
              <a onclick="get_todos('{{ $tu->user->id }}')" class="pointer">{{ $tu->user->FullName }}</a>
            </li>
          @empty
            @emptylist(You havent assigned todos to anyone.)
          @endforelse
        </ul>

      </div>
    </div>
    <div class="col-md-8">
      <div class="card-box">
        <div id="todos-title" class="card-title"></div>
        {{-- <p></p> --}}
        <ul id="todos" class="my-list">
          @emptylist(No user selected)
        </ul>

      </div>
    </div>
  </div>

  <!-- Modal: New Todo -->
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

  <!-- Modal: Edit Todo -->
  <div class="modal fade slide-up disable-scroll" id="edit_todo" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit To-Do</h5>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('Todo', 'Todo Item' ) }}
                    {{-- <input type="text" class="form-control" name="Event" placeholder="Enter event title" required> --}}
                    {{ Form::text('Todo', null, ['class' => 'form-control', 'placeholder' => 'Enter todo', 'required']) }}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('DueDate', 'Due Date' ) }}
                    <div class="input-group date dp">
                      {{ Form::text('DueDate', null, ['class' => 'form-control', 'placeholder' => 'Due Date', 'required']) }}
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::label('UserID', 'Assign To') }}
                    {{-- <span class="help">Leave empty to assign to yourself.</span> --}}
                    {{ Form::select('UserID', [ '' =>  'Select Staff'] + $staffs->pluck('FullName', 'UserID')->toArray(), auth()->id(), ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                  </div>
                </div>

              </div>
              <button type="submit" class="btn btn-info btn-form">Submit</button>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('scripts')
  <script>
    function get_todos(id) {
      $('#spinner').show();

      $.get('/get_assigned_todos/'+id, function(data, status){
        $('#todos').empty();
        // $.each(data, function(index, todo){
        //   console.log(todo);
        // });
        data.forEach(function(todo){
          // console.log(todo);
          $('#todos').append(`
            <li style="position:relative">
              <div class="f15">${todo.Todo}</div>
              <div class="small text-muted m-t-5">Date: ${todo.DueDate}</div>
              <div class="step-actions inline-block text-right pointer" style="position:absolute;top:5px;right:10px">
                <a data-toggle="modal" data-target="#edit_todo" onclick="edit_data(['${todo.TodoRef}', '${todo.Todo}', '${todo.UserID}', '${todo.DueDate}'])"><i class="fa fa-pencil text-warning"></i></a>
              </div>
            </li>
          `);
          $('#todos-title').html(todo.user.first_name+' '+todo.user.last_name+'\'s To-Dos<br><p class="text-muted" style="text-transform:initial">A list of to-dos you have assigned to this person.</p>');
        });
        $('#spinner').hide();
      });
    }

    function edit_data(data) {
      // console.log(data);
      $('#edit_todo').find('input[name=Todo]').val(data[1]);
      $('#edit_todo').find('select[name=UserID]').val(data[2]).trigger('change');
      $('#edit_todo').find('input[name=DueDate]').val(data[3]);
      $('#edit_todo').find('form').attr('action', '/update_todo/'+data[0]);
    }
  </script>
@endpush
