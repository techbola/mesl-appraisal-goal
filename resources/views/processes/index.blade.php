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
         <ul class="nav nav-pills pull-right">
             <ul class="nav nav-pills pull-right">
             {{-- <li role="presentation" class="active"><a href="{{ route('PolicyApprover') }}">Create Policy Approver</a></li> --}}
             <li><a style="background: #bbb" href="{{ route('ProcessManagement') }}">Return to Process Management Page</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewProcess') }}">Create New/View Process</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateProcessSteps') }}">Create New/View Process Steps</a></li>
         </ul>
         </ul>
      </div><div class="clearfix"></div>
  			<div class="card-title pull-left" style="font-size: 20px !important">Company Process Management Module</div><div class="clearfix"></div>
           <div class="row"><hr>
               <div class="col-md-4">
                    <div class="form-group">
                    <div class="controls">
                        {{ Form::label('Select Process' ) }}
                            {{ Form::select('ProcessRef', [ '' =>  'Select a Process'] + $processes->pluck('process', 'processRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose policy",'id'=>'process_id', 'onchange' => 'add_step()', 'data-init-plugin' => "select2", 'required']) }}
                    </div>
                  </div>

                  <div class="hide" id="segments" style="margin-top: 20px; padding: 20px; background: #d4e8e9; ">
                    <h3>Segments</h3><hr>
                    <ol id="segments_list">
                      
                    </ol>
                  </div>        
              </div>

            <div class="col-md-12 hide" id="process_step">
            <div style="padding: 20px; background: #eee">
          
              <table class="table table-hover">
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
              </table>

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
        $('#process').val(' ');
        $('#process').val(id);
        $('#step_list').html(' ');

        $.get('/get_process_steps/'+id, function(data, status) {

           $.each(data, function(index, val){
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
        });
      }

  </script>

@endpush


