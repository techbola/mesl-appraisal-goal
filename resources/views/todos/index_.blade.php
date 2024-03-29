@extends('layouts.master')

@section('title')
  To-Do List
@endsection

@section('page-title')
  To-Do List
@endsection

@section('buttons')

  <a class="btn btn-sm btn-info btn-rounded" href="{{ route('todos_calendar') }}"><i class="fa fa-calendar m-r-5"></i> Back to Calendar</a>
  <a href="{{ route('assigned_todos') }}" class="btn btn-info btn-rounded">Assigned To-Dos</a>
  <a href="{{ route('todos') }}" class="btn btn-info btn-rounded">My To-Dos</a>
  <a href="{{ route('unassigned_todos') }}" class="btn btn-info btn-rounded">Unassigned To-Dos</a>
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

      {{-- START TABS --}}
      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#undone">To-Dos</a></li>
        <li><a data-toggle="tab" href="#done">Done</a></li>
      </ul>
      <div class="tab-content">
        <div id="undone" class="tab-pane fade in active">

          @include('todos.undone')

        </div>
        <div id="done" class="tab-pane fade">

          @include('todos.done-block')

        </div>
      </div>
      {{-- END TABS --}}

    </div>


  </div>

  @include('todos.add_edit_modal')



  <!-- Modal -->
  {{-- <div class="modal fade slide-up disable-scroll" id="new_todo" role="dialog" aria-hidden="false">
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
  </div> --}}

@endsection

@push('scripts')
  <script>
  function reload_steps() {
    location.reload();
  }

  function toggle_step(id) {
    var base = '{{ url('/') }}';
    $.get(base+'/toggle_todo/'+id, function(data, status){
      if (data.Done == '1') {
        $('#step_id_'+id).closest('div').find('label').addClass('strike');
      } else {
        $('#step_id_'+id).closest('div').find('label').removeClass('strike');
      }
    });

  }
  </script>
@endpush
