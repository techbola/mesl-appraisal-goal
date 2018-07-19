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
                        {{ Form::label('Select Process Department' ) }}
                            {{ Form::select('ProcessRef', [ '' =>  'Select a Process Department'] + $depts->pluck('ProcessDept', 'DeptRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Process Department",'id'=>'departments', 'onchange'=>'get_departments()', 'data-init-plugin' => "select2", 'required']) }}
                    </div>
             </div>
          </div>

          <div class="col-md-4">
             <div class="form-group">
                    <div class="controls">
                        {{ Form::label('Select Process' ) }}
                            <select name="ProcessRef" class="full-width" data-init-plugin="select2" id="process_id" onchange="add_step()" required>
                              <option value=''>Choose Process</option>
                            </select>
                           
                    </div>
                  </div>
          </div>
        </div>

          <div class="row"><hr>
          <div class="col-md-12 hide" id="process_step">
            <div style="padding: 20px; background: #eee">
              <h2 id="process_title"></h2>
              {{ Form::open(['id'=>'update_step_form','autocomplete' => 'off', 'role' => 'form']) }}
              <p>
                <a href="#" style="color: #fff" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler" class="btn btn-lg btn-success pull-right">Add Process Step</a>&nbsp; &nbsp;
                {{-- <a href="#" style="color: #fff; right: 5px" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler" class="btn btn-lg btn-default pull-right">Add Process Step</a>&nbsp; &nbsp; --}}
                <a href="#" style="color: #fff; right: 5px" data-target="#modalFillIn4" data-toggle="modal" id="add_attribute" class="btn btn-lg btn-info pull-right" style="color: #fff; right: 5px">Add Process Attribute</a>&nbsp; &nbsp;
                <a href="#" style="color: #fff; right: 10px" data-target="#modalFillIn5" data-toggle="modal" id="add_risk" class="btn btn-lg btn-complete pull-right">Risks & Controls</a>&nbsp; &nbsp;
                <a href="#" id="edit_step" style="margin-right: 10px; right: 5px" class="btn btn-lg btn-warning pull-right hide">Edit Process Steps</a>
                <a href="#" id="update_step" style="margin-right: 10px; right: 5px" class="btn btn-lg btn-primary pull-right hide">Update Process Steps</a>
              </p>
              <div class="clearfix"></div>
              <br>

              <div style="background: #cde3f5; padding: 20px">
                 <div class="row">
                   <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th style="color: #000; font-weight: bold">Frequency</th>
                          <th style="color: #000; font-weight: bold">Nunmber of Staff</th>
                          <th style="color: #000; font-weight: bold">Turn Around Time</th>
                          <th style="color: #000; font-weight: bold">Action</th>
                        </tr>
                      </thead>
                      <tbody id="attributes">
                        
                      </tbody>
                   </table>
                 </div>
              </div>
              <br><br>

              <table class="table table-hover table-bordered">
                <thead>
                  <tr style="background: #fff">
                    <th class="mno hide" style="width:10%; font-weight: bold; color: #000">Edit Step</th>
                    <th class="fred" style="width:10%; font-weight: bold; color: #000">Steps</th>
                    <th style="width:10%; font-weight: bold; color: #000">Responsiblity</th>
                    <th style="width:50%; font-weight: bold; color: #000">Task</th>
                    <th style="width:20%; font-weight: bold; color: #000">Job Aid</th>
                    <th style="width:10%; font-weight: bold; color: #000">Action</th>
                  </tr>
                </thead>
                <tbody id="step_list">
                </tbody>
              </table>
               {{ Form::close() }}

              <div style="background: #cde3f5; padding: 20px">
                 <div class="row">
                  <h3>Risk &Control</h3>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr style="background: #fff">
                    <th style="width: 10%; font-weight: bold; color: #000 !important"></th>
                    <th style="width: 35%; font-weight: bold; color: #000 !important">Risk</th>
                    <th style="width: 35%; font-weight: bold; color: #000 !important">Control</th>
                    <th style="width: 20%; font-weight: bold; color: #000 !important">Action</th>
                  </tr>
                </thead>
                <tbody id="risk_list">
                </tbody>
              </table>
            </div>
          </div>

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
          <div class="modal fade fill-in" id="modalFillIn4"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 900px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold"><span class="semi-bold text-info" id="title"></span> Process Attribute</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                          {{ Form::open(['id'=>'attribute_form','autocomplete' => 'off', 'role' => 'form']) }}
                          <div id="item_div">
                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Frequency' ) }}
                                               {{ Form::text('Frequency', null, ['class' => 'form-control', 'id'=>'frequency', 'placeholder' => 'Add Frequency', 'required']) }}
                                       </div>
                                  </div>
                                </div>

                                <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Number of Staff' ) }}
                                               {{ Form::text('staff_no', null, ['class' => 'form-control', 'id'=>'staff_no', 'placeholder' => 'Number of Staff', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                                <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('TAT', 'Turn Around Time') }}
                                               {{ Form::text('TAT', null, ['class' => 'form-control','id'=>'tat', 'placeholder' => 'Input Turn Around Time']) }}
                                       </div>
                                  </div>
                              </div>

                              <input type="hidden" name="process_id" id="process_attribute_id">
                            </div>
                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="submit_attribute" data-dismiss="modal" value="Add New Attribute">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="save_attribute" data-dismiss="modal" value="Save Attribute">
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
          <div class="modal fade fill-in" id="modalFillIn5"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold">Add Process Risk & Control</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                          {{ Form::open(['id'=>'risk_form','autocomplete' => 'off', 'role' => 'form']) }}
                          <div id="item_div">
                              <div class="col-sm-12">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Risk' ) }}
                                               {{ Form::textarea('risk', null, ['class' => 'form-control', 'id'=>'risk', 'placeholder' => 'Add Risk', 'rows'=>'3', 'required']) }}
                                       </div>
                                  </div>
                                </div>

                                <div class="col-sm-12">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Control' ) }}
                                               {{ Form::textarea('control', null, ['class' => 'form-control', 'id'=>'control', 'placeholder' => 'Control', 'rows'=>'3', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <input type="hidden" name="process_id" id="process_risk_id">
                            </div>
                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="submit_risk" data-dismiss="modal" value="Add ">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="save_risk" data-dismiss="modal" value="Save ">
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

           $.each(data.step, function(index, val){
             $('#step_list').append(`
              <tr><td id='abc' class='abc hide'><input name='Step_Number[]' value='${val.Step_Number}' class='form-control'></td>
                  <td id='xyz' class='step'>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a></td>
                  <td class='hide'><input name='ProcessStepRef[]' value='${val.ProcessStepRef}'></td>
              </tr>
             `);
            });

           $('#attributes').html(' ');
             $('#attributes').append(`
              <tr>
                  <td>${data.attribute.frequency}</td>
                  <td>${data.attribute.staff_no}</td>
                  <td>${data.attribute.TAT}</td>
                  <td><a href="#" id="zone" data-id='${data.attribute.process_attribute_ref}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a></td>
              </tr>
             `);

             $('#risk_list').html(' ');
            var sn = 1;
            $.each(data.risk, function(index, val){
             $('#risk_list').append(`
              <tr>
                  <td>${sn++}</td>
                  <td>${val.risk}</td>
                  <td>${val.control}</td>
                  <td><a href="#" id="bay" data-id='${val.process_risk_control_ref}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.process_risk_control_ref}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a>
                  </td>
              </tr>
             `);
            });


           $('#responsibility').val(' ');
           $('#job_aid').val(' ');
           $('#item_div .note-editable').text(' ');

           var count = data.step.length;
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
          $.each(data.step, function(index, val){
             $('#step_list').append(`
              <tr>
              <td id='abc' class='abc hide'><input name='Step_Number[]' value='${val.Step_Number}' class='form-control'></td>
                  <td id='xyz' class='step'>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a></td>
              </tr>
             `);
          });


          $('#attributes').html(' ');
          $.each(data.attribute, function(index, val){
             $('#attributes').append(`
              <tr>
                  <td>${val.frequency}</td>
                  <td>${val.staff_no}</td>
                  <td>${val.TAT}</td>
                  <td><a href="#" id="bay" data-id='${val.process_attribute_id}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a></td>
              </tr>
             `);
          });

           $('#responsibility').val(' ');
           $('#job_aid').val(' ');
          $('#item_div .note-editable').text(' ');
          
           $('.fred').removeClass('hide');
           $('.mno').addClass('hide');
           
           var count = data.step.length;
           if(count > 1)
           {
            $('#edit_step').removeClass('hide');
            $('#update_step').addClass('hide');
           }else
           {
            $('#edit_step').addClass('hide');
            $('#update_step').addClass('hide');
           }

          // void request
          return false;
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
          $.each(data.step, function(index, val){
             $('#step_list').append(`
              <tr>
                  <td id='abc' class='abc hide'><input name='Step_Number[]' value='${val.Step_Number}' class='form-control'></td>
                  <td id='xyz' class='step'>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a></td>
              </tr>
             `);

            $('#attributes').html(' ');
             $.each(data.attribute, function(index, val){
             $('#attributes').append(`
              <tr>
                  <td>${val.frequency}</td>
                  <td>${val.staff_no}</td>
                  <td>${val.TAT}</td>
                  <td><a href="#" id="bay" data-id='${val.process_attribute_id}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a></td>
              </tr>
             `);
          });

            });

            $('.fred').removeClass('hide');
            $('.mno').addClass('hide');
            $('#edit_step').removeClass('hide');
            $('#update_step').addClass('hide');

            $('#responsibility').val(' ');
           $('#job_aid').val(' ');
           $('#item_div .note-editable').text(' ');
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
              $.each(data.step, function(index, val){
             $('#step_list').append(`
              <tr>
              <td id='abc' class='abc hide'><input name='Step_Number[]' value='${val.Step_Number}' class='form-control'></td>
                  <td id='xyz' class='step'>Step ${val.Step_Number}</td>
                  <td>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
                  <td><a href="#" id="bay" data-id='${val.ProcessStepRef}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.ProcessStepRef}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a>
                  </td>
              </tr>
             `);
            });


            $('#attributes').html(' ');
             $.each(data.attribute, function(index, val){
             $('#attributes').append(`
              <tr>
                  <td>${val.frequency}</td>
                  <td>${val.staff_no}</td>
                  <td>${val.TAT}</td>
                  <td><a href="#" id="bay" data-id='${val.process_attribute_id}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a></td>
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
                 <td id='abc' class='abc hide'><input name='Step_Number[]' value='${val.Step_Number}' class='form-control'></td>
                  <td id='xyz' class='step'>Step ${val.Step_Number}</td>
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


  $(document).on('click', '#add_attribute', function(event) {
    var proc = $('#process_id').val();
    $('#process_attribute_id').val(proc);
  });

  $(document).on('click', '#submit_attribute', function(event) {

   $.post('/submit_process_attribute', $('#attribute_form').serialize(), function(data, status) {

    $('#attributes').html(' ');
             $('#attributes').append(`
              <tr>
                  <td>${data.frequency}</td>
                  <td>${data.staff_no}</td>
                  <td>${data.TAT}</td>
                  <td><a href="#" id="zone" data-id='${data.process_attribute_ref}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a></td>
              </tr>
             `);
             console.log(data);
    
   });

   });


    $(document).on('click', '#add_risk', function(event) {
    var proc = $('#process_id').val();
    $('#process_risk_id').val(proc);
  });


  $(document).on('click', '#submit_risk', function(event) {
   $.post('/submit_process_risk', $('#risk_form').serialize(), function(data, status) {
     $('#risk_list').html(' ');
     var id = 1;
              $.each(data, function(index, val){
             $('#risk_list').append(`
              <tr>
                  <td>${id++}</td>
                  <td>${val.risk}</td>
                  <td>${val.control}</td>
                  <td><a href="#" id="bay" data-id='${val.process_risk_control_ref}' data-target="#modalFillIn2" data-toggle="modal" style ="color:blue">Edit</a> | <a href="#" data-id='${val.process_risk_control_ref}' data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler2" style ="color:Red">delete</a>
                  </td>
              </tr>
             `);
            });
   });
  });

  $(document).on('click', '#zone', function(event) {
      $('#submit_attribute').addClass('hide');
      $('#save_attribute').removeClass('hide')
      var id = $(this).data('id');

      $.get('/get_attribute_values/' +id, function(data) {
        /*optional stuff to do after success */
      });
  });

  </script>

  <script>
    
    function get_departments()
    {
     var id = $('#departments').val();
     $.get('/get_process_steps_dept/' +id, function(data, status) {
       $.each(data, function(index, val){
             $('#process_id').append(`
                  <option value='${val.processRef}'>${val.process}</option>
             `);
            });
     });
   }

  </script>

@endpush


