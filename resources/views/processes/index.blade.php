@extends('layouts.master')

@push('styles')
<style>
  .panel-group .panel-heading .panel-title>a {
    color: #626262;
    font-size: 16px;
    font-weight: bold;
    display: block;
    opacity: 1;
}

hr {
    margin-top: -8px !important;
}
</style>
@endpush

@section('title')
  Process Management
@endsection

@section('page-title')
  Process Management
@endsection

@section('buttons')
  
@endsection
s
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
        @if(count($check) >= 1)
          <ul class="nav nav-pills pull-right">
             {{-- <li role="presentation" class="active"><a href="{{ route('PolicyApprover') }}">Create Policy Approver</a></li> --}}
             {{-- <li><a style="background: #bbb" href="{{ route('ProcessManagement') }}">Return to Process Management Page</a></li> --}}
             <li><a class="btn btn-info btn-lg" style="color: #fff" href="{{ route('ProcessApprover') }}">View / Add New Process Maker</a></li>
              <li role="presentation" class="active"><a href="{{ route('ProcessDepartments') }}"> New/View Process Department</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewProcess') }}"> New/View Process</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateProcessSteps') }}"> New/View Process Steps</a></li>
         </ul>
        @endif
      </div><br><br><div class="clearfix"></div>
  			<div class="card-title pull-left" style="font-size: 20px !important">Company Process Management Module</div><div class="clearfix"></div>
           <div class="row"><hr>
              <div class="col-md-5">
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

            <div class="row"><br><hr>
            <div class="col-md-12 hide" id="process_step">
            <div style="padding: 20px; background: #eee">
                 <div class="row">
                  <div class="col-md-6 col-md-offset-6">
                    <div style="background: #cde3f5; padding: 20px">
                    <h3>Process Attribute</h3><hr>
                   <table class="table">
                      <thead>
                        <tr>
                          <th style="color: #000; font-weight: bold">Frequency</th>
                          <th style="color: #000; font-weight: bold">Nunmber of Staff</th>
                          <th style="color: #000; font-weight: bold">Turn Around Time</th>
                        </tr>
                      </thead>
                      <tbody id="attributes">
                        
                      </tbody>
                   </table>
                 </div>
                 </div>
              </div>
              <br>

              <h2 class="semi-bold" id="title"></h2>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr style="background: #fff">
                    <th style="width:10%">Steps</th>
                    <th style="width:10%">Responsiblity</th>
                    <th style="width:55%">Task</th>
                    <th style="width:25%">Job Aid</th>
                  </tr>
                </thead>
                <tbody id="step_list">
                </tbody>
              </table><br>


              <h2>Risk & Controls</h2>
               <div style="background: #cde3f5; padding: 20px">
                 <div class="row">
                   <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th style="color: #000; font-weight: bold">Risk</th>
                          <th style="color: #000; font-weight: bold">Controls</th>
                        </tr>
                      </thead>
                      <tbody id="risk_list">
                      </tbody>
                   </table>
                 </div>
              </div>
              <br>

            </div>
          </div>

           </div>
  	</div>
  	<!-- END PANEL -->
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
        $('#title').html(title);
        $('#step_list').html(' ');

        $.get('/get_process_steps/'+id, function(data, status) {

           $.each(data.step, function(index, val){
             $('#step_list').append(`
              <tr>
                  <td>Step ${val.Step_Number}</td>
                  <td>${val.Responsibility}</td>
                  <td>${val.Task}</td>
                  <td>${val.Job_Aid}</td>
              </tr>
               <option value="${val.ProductRef}">${val.ProductService}</option>
             `);
            });

            $('#attributes').html(' ');
             $('#attributes').append(`
              <tr>
                  <td>${data.attribute.frequency}</td>
                  <td>${data.attribute.staff_no}</td>
                  <td>${data.attribute.TAT}</td>
              </tr>
             `);

              $('#risk_list').html(' ');
              $.each(data.risk, function(index, val){
             $('#risk_list').append(`
              <tr>
                  <td>${val.risk}</td>
                  <td>${val.control}</td>
              </tr>
             `);
            });

        });
      }

  </script>

  <script>
    
    function get_departments()
    {
     var id = $('#departments').val();
     $.get('/get_process_steps_dept_index/' +id, function(data, status) {
        $('#process_id').html('<option value="">Choose Process</option>');
       $.each(data, function(index, val){
             $('#process_id').append(`
                  <option value='${val.processRef}'>${val.process}</option>
             `);
            });
     });
   }

  </script>

@endpush


