@extends('layouts.master')

@section('title')
  {{-- Task - {{ $task->Task }} --}}
@endsection

@section('page-title')
  Assigned To-Dos
@endsection

@section('buttons')
  {{-- <a class="btn btn-sm btn-info btn-rounded" href="{{ route('todos_calendar') }}"><i class="fa fa-calendar m-r-5"></i> Back to Calendar</a> --}}
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
        <ul id="todos" class="my-list">
          @emptylist(No user selected)
        </ul>

      </div>
    </div>
  </div>
@endsection

{{-- ////////////// --}}




@push('scripts')
  <script>
    function get_todos(id) {
      $('#spinner').show();

      $.get('/get_assigned_todos/'+id, function(data, status){
        // $.each(data, function(index, todo){
        //   console.log(todo);
        // });
        $('#todos').empty();
        data.forEach(function(todo){
          console.log(todo);
          $('#todos').append(`
            <li>
              <div class="f15">${todo.Todo}</div>
              <div class="small text-muted m-t-5">Date: ${todo.DueDate}</div>
            </li>
          `);
          $('#todos-title').text(todo.user.first_name+' '+todo.user.last_name+'\'s To-Dos');
        });
        $('#spinner').hide();
      });
    }
  </script>
@endpush
