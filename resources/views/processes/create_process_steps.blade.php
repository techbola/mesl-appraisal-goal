@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

tfoot{
      display: table-header-group;
     }

}

.note-editor.note-frame .note-editing-area .note-editable {
    padding: 30px !important;
    overflow: auto;
    color: #000;
    word-wrap: break-word;
    background-color: #fff;
}
  </style>
@endpush

@section('title')
  Create Process Steps
@endsection

@section('page-title')
  Create Process Steps
@endsection

@section('buttons')
  
@endsection 

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
        
      </div><div class="clearfix"></div>
      <div style="padding: 30px">
        @if(count($check) >= 1)
         <ul class="nav nav-pills pull-right">
             <li><a style="background: #bbb" href="{{ route('ProcessManagement') }}">Return to Process Management Page</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewProcess') }}">Create New/View Process</a></li>
         </ul>
        @endif 
      </div><div class="clearfix"></div>

      <div class="card-title pull-left" style="font-size: 20px !important">Company Process Steps</div><div class="clearfix"></div>

        <div class="row"><hr>
          <div class="col-md-4">
             <div class="form-group">
                    <div class="controls">
                        {{ Form::label('Select Process' ) }}
                            {{ Form::select('ProcessRef', [ '' =>  'Select a Process'] + $processes->pluck('process', 'processRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose policy",'id'=>'process_id', 'onchange' => 'add_step()', 'data-init-plugin' => "select2", 'required']) }}
                    </div>
                  </div>
          </div>

          <div class="col-md-12 hide" id="process_step">
            <div style="padding: 20px; background: #eee">
              <h2 id="process_title"></h2>
              {{ Form::open(['id'=>'update_step_form','autocomplete' => 'off', 'role' => 'form']) }}
              <p>
                <a href="#" style="color: #fff" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler" class="btn btn-lg btn-success pull-right">Add Process Step</a>&nbsp; &nbsp;
                <a href="#" id="edit_step" style="margin-right: 5px" class="btn btn-lg btn-warning pull-right hide">Edit Process Steps</a>
                <a href="#" id="update_step" style="margin-right: 5px" class="btn btn-lg btn-primary pull-right hide">Update Process Steps</a>
              </p>
              <div class="clearfix"></div>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr style="background: #fff">
                    <th class="mno hide" style="width:10%">Edit Step</th>
                    <th class="fred" style="width:10%">Steps</th>
                    <th style="width:10%">Responsiblity</th>
                    <th style="width:50%">Task</th>
                    <th style="width:20%">Job Aid</th>
                    <th style="width:10%">Action</th>
                  </tr>
                </thead>
                <tbody id="step_list">
                </tbody>
              </table>
               {{ Form::close() }}
            </div>
          </div>
        </div>

  	</div>
  	<!-- END PANEL -->

    <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 1000px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold"><span id="neon">Add New</span> Process Step  <span class="semi-bold text-info" id="title"></span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                          {{ Form::open(['id'=>'step_form','autocomplete' => 'off', 'role' => 'form']) }}
                          <div id="item_div">
                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Responsibility' ) }}
                                               {{ Form::text('Responsibility', null, ['class' => 'form-control', 'id'=>'responsibility', 'placeholder' => 'Add Responsibility', 'required']) }}
                                       </div>
                                  </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Job Aid' ) }}
                                               {{ Form::text('Job_Aid', null, ['class' => 'form-control', 'id'=>'job_aid', 'placeholder' => 'Add New Process', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                                <div class="col-sm-12">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Task', 'Task') }}
                                               {{ Form::textarea('Task', null, ['class' => 'summernote form-control','id'=>'task', 'placeholder' => 'Be expressive']) }}
                                       </div>
                                  </div>
                              </div>
                            </div>

                                    <input type="hidden" name="ProcessID" id="process">
                                    <input type="hidden" name="ProcessStepRef" id="process_step_ref">
                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_step" data-dismiss="modal" value="Add New Step">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="save_step" data-dismiss="modal" value="Save Step">
                              </div>
                            {{ Form::close() }}
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

        <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn3"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 500px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold">Process Step Deletion </h5>
                </div><hr>
                <div class="modal-body">
                  <div class="row">
                        Are you sure you want to delete this step ? <br>
                            <input type="hidden" id="delete_id" name="ProcessStepRef">
                            <a href="#" id="deleted_process" class="btn btn-danger btn-lg pull-right" data-dismiss="modal" title="">Delete Step</a>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

@endsection

@push('scripts')
  
  <script>
    
      function add_step()
      {
        $('#process_step').removeClass('hide');
        var id = $('#process_id').val();
        var title = $('#process_id :selected').text();
        $('#process').val(' ');
        $('#process').val(id);
        $('#title ').html(title);
        $('#process_title').html(title);
        $('#neon').text('Add New');

        $.get('/get_process_steps/'+id, function(data, status) {
          $('#step_list').html(' ');
           $.each(data, function(index, val){
             $('#step_list').append(`
              <tr><td id='abc' class='abc hide'><input name='Step_Number[]' value='${val.Step_Number}'></td>
                  <td id='xyz' class='step'>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a></td>
                  <td class='hide'><input name='ProcessStepRef[]' value='${val.ProcessStepRef}'></td>
              </tr>
             `);
            });

           $('#responsibility').val(' ');
           $('#job_aid').val(' ');
           $('#item_div .note-editable').text(' ');

           var count = data.length;
           if(count > 1)
           {
            $('#edit_step').removeClass('hide');
            $('#update_step').addClass('hide');
           }else
           {
            $('#edit_step').addClass('hide');
            $('#update_step').addClass('hide');
           }
        });
      }

  </script>

  <script>
    
      $('#add_step').click(function() {
        $.post('/post_process_step', $('#step_form').serialize(), function(data, status) {

          $('#step_list').html(' ');
          $.each(data, function(index, val){
             $('#step_list').append(`
              <tr>
                  <td>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a></td>
              </tr>
             `);
            });

           $('#responsibility').val(' ');
           $('#job_aid').val(' ');
           $('#task').val(' ');

           $('.fred').removeClass('hide');
           $('.mno').addClass('hide');
           
           var count = data.length;
           if(count > 1)
           {
            $('#edit_step').removeClass('hide');
            $('#update_step').addClass('hide');
           }else
           {
            $('#edit_step').addClass('hide');
            $('#update_step').addClass('hide');
           }

        });
      });

  </script>

  <script>
    $('#edit_step').click(function(event) {
      $('.fred').addClass('hide');
      $('.step').addClass('hide');
      $('.abc').removeClass('hide');
      $('.mno').removeClass('hide');
      $('#edit_step').addClass('hide');
      $('#update_step').removeClass('hide');
    });
  </script>

  <script>
    $('#update_step').click(function() {
        $.post('/update_process_step', $('#update_step_form').serialize(), function(data, status) {

           $('#step_list').html(' ');
          $.each(data, function(index, val){
             $('#step_list').append(`
              <tr>
                  <td>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a></td>
              </tr>
             `);
            });

            $('.fred').removeClass('hide');
            $('.mno').addClass('hide');
            $('#edit_step').removeClass('hide');
            $('#update_step').addClass('hide');
        });
      });
  </script>

  <script>
    
   $(document).on('click', '#bay', function(event) {
         $('#responsibility').val(' ');
         $('#job_aid').val(' ');
         $('#task').val(' ');
         $('#add_step').addClass('hide');
         $('#save_step').removeClass('hide');
         $('#neon').text('Edit');
         var proc = $('#process_id').val();
         $('#process').val(proc);
         var id = $(this).data('id');
         $('#process_step_ref').val(id);
         $.get('/get_step_values/'+id, function(data) {

          $('#responsibility').val(data.Responsibility);
          $('#job_aid').val(data.Job_Aid);
          $('#item_div .note-editable').html(data.Task);

         });
    });


   $(document).on('click', '#save_step', function(event) {      
           $.post('/update_step_values', $('#step_form').serialize(), function(data, status) {
             $('#step_list').html(' ');
              $.each(data, function(index, val){
             $('#step_list').append(`
              <tr>
                  <td>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a>
                  </td>
              </tr>
             `);
            });
      });
   });

   $(document).on('click', '#btnFillSizeToggler2', function(event) {
     var id = $(this).data('id');
     $('#delete_id').val(id);
   });



  $(document).on('click', '#deleted_process', function(event) {
     var id = $('#delete_id').val();
     var proc = $('#process_id').val();
     $.get('/delete_process_step/'+id+'/'+proc, function(data) {
      $('#step_list').html(' ');
              $.each(data, function(index, val){
             $('#step_list').append(`
              <tr>
                  <td>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a>
                  </td>
              </tr>
             `);
            });

              var count = data.length;
           if(count > 1)
           {
            $('#edit_step').removeClass('hide');
            $('#update_step').addClass('hide');
           }else
           {
            $('#edit_step').addClass('hide');
            $('#update_step').addClass('hide');
           }
     });
  });

  </script>

@endpush


