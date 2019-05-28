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
          <form action="{{ route('save_todo') }}" method="post" id="todo_form">
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
          <form action="" method="post" id="todo_form">
            {{ csrf_field() }}
            {{-- {{ method_field('PATCH') }} --}}
            <input type="hidden" id="TodoID" value="">
            @include('todos.form')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@push('scripts')
  <script>
      $('.new_todo').click(function(){
        // $('#new_todo form').reset();
        $('#new_todo').find('form').attr('action', '{{ route('save_todo') }}');
        $('#new_todo [name="assignees[]"]').select2().destroy();
      });

      function edit_data(id) {
        // console.log(data);
        // document.getElementById('todo_form').reset();
        // $('#edit_todo').find('input[name=Todo]').val(data[1]);
        // $('#edit_todo').find('select[name="assignees[]"]').val(data[2]).trigger('change');
        // $('#edit_todo').find('input[name=DueDate]').val(data[3]);
        // $('#edit_todo').find('#TodoID').val(data[0]);
        // $('#edit_todo').find('form').attr('action', '/update_todo/'+data[0]);

        $.get('/get_todo/'+id, function(data, status) {
          document.getElementById('todo_form').reset();
          $('#edit_todo').find('input[name=Todo]').val(data.Todo);
          $('#edit_todo').find('select[name="assignees[]"]').val(data.assignees.map(a => a.id)).trigger('change');
          $('#edit_todo').find('input[name=DueDate]').val(data.DueDate);
          if (data.StartTime) {
            $('#edit_todo').find('input[name=StartTime]').timepicker('setTime', moment(data.StartTime, 'HH:mm:ss').format('h:mm A'));
          } else {
            $('#edit_todo').find('input[name=StartTime]').val(null);
          }

          if (data.EndTime) {
            $('#edit_todo').find('input[name=EndTime]').timepicker('setTime', moment(data.EndTime, 'HH:mm:ss').format('h:mm A'));
          } else {
            $('#edit_todo').find('input[name=EndTime]').val(null);
          }
          $('#edit_todo').find('#TodoID').val(data.TodoRef);
          $('#edit_todo').find('form').attr('action', '/update_todo/'+data.TodoRef);
        });

      }

      $('#edit_todo form').submit(function(e){
        e.preventDefault();
        var id = $('#edit_todo #TodoID').val();
        // $('#edit_todo').modal('hide');
        $("[data-dismiss=modal]").trigger({ type: "click" });
        $.post('/update_todo_ajax/'+id, $(this).serialize(), function(data, status){
          // console.log(data);
          location.reload();
        });
      });
  </script>
@endpush
