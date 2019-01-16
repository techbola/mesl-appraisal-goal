@extends('layouts.master')

@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">

    @endpush
@include('errors.list')

@section('content')
    <div class="card-box">
        <center><div class="card-title"><h4><strong>Leave Handover</strong></h4></div></center>
        <form action="" class="form">
            {{ csrf_field() }}
                {{-- Row 1 --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('AbsenceTypeID','Leave Type') }}
                            {{ Form::select('AbsenceTypeID', [ '' =>  'Absence Type'] + $leave_type->pluck('LeaveType', 'LeaveTypeRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Leave Type", 'data-init-plugin' => "select2", 'required']) }}                
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('StartDate', 'Start Date' ) }}
                        <div class="input-group date dp">
                            {{ Form::text('StartDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Commencement Date', 'required', 'id' => 'start_Date']) }}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                        <div class="form-group">
                        {{ Form::label('Number_of_Leavedays', 'Number of leave days' ) }}
                        {{ Form::text('NumberofDays', null, ['class' => 'form-control', 'placeholder' => 'Number of Leave Days', 'required', 'id'=>'numberdays', 'onblur'=>'check_leave_days()', ]) }}
                        </div>
                    </div>
            
                <div class="col-md-3">
                    <div class="form-group">
                    {{ Form::label('ReturnDate', 'End Date' ) }}
                    <div class="input-group date dp">
                        {{ Form::text('ReturnDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'End Date', 'required', 'id'=>'return_date']) }}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                    </div>
                </div>
            </div>

            <br>
            {{-- Row 2
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('ReliefOfficerID','Relieved By') }}
                        {{ Form::select('ReliefOfficerID', [ '' =>  'Releif Officer'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Relieved By", 'data-init-plugin' => "select2"]) }}
                    </div>
                </div>
            </div> --}}

            <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                {{ Form::label('EmployeeName','Staff Name') }}
                                {{ Form::text('EmployeeName', Auth::user()->FullName, ['class' => 'form-control', 'placeholder' => 'Employee Name', 'required', 'readonly' ]) }}
                            </div>
                        </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('ApproverID2','Relievers Name') }}
                            {{ Form::select('ApproverID2', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2", 'required']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('ApproverID3','Supervisors Name') }}
                            {{ Form::select('ApproverID3', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2"]) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('ApproverID4','HR Approval ') }}
                            {{ Form::select('ApproverID4', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2"]) }}
                        </div>
                    </div>
                </div>
        </form>
    </div>


    {{-- row 3 --}}
    <div class="card-box">
        <center><div class="card-title"><h5><strong>Task(s)</strong></h5></div></center>
        <br>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                Add New Task
        </button>
        <table class="table table-bordered" id="taskTable">
            <thead>
                <tr>
                <th scope="col">S/N</th>
                <th scope="col">Task(s)</th>
                <th scope="col">Description</th>
                <th scope="col">Deadline</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                @foreach($handover_tasks as $handover_task)
                <?php $count = $count + 1; ?>
                    <tr>
                    <th>{{ $count }}</th>
                    <td>{{ $handover_task->HandoverTaskTitle }}</td>
                    <td>{{ $handover_task->HandoverTaskDescription }}</td>
                    <td>{{ $handover_task->HandoverDeadline }}</td>
                    <td><a href="{{ route('delete', $handover_task->HandoverTaskRef) }}" type="delete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        {{-- Modal --}}
        <!-- Button trigger modal -->
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 400px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="form-task">
                    {{ csrf_field() }}
                    <input type="hidden" id="HandoverTaskRef" name="HandoverTaskRef" value="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('HandoverTaskTitle', 'Create task' ) }}
                                    {{ Form::text('HandoverTaskTitle', null, ['class' => 'form-control', 'id' => 'task_title', 'placeholder' => 'Create task', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('HandoverTaskDesceiption', 'Task Description' ) }}
                                    {{ Form::textarea('HandoverTaskDescription', null, ['class' => 'form-control', 'id' => 'task_description', 'placeholder' => 'Explain the task in detail....', 'rows' => '4', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('HandoverDeadline', 'Deadline' ) }}
                                <div class="input-group date dp">
                                    {{ Form::text('HandoverDeadline', date('Y-m-d'), ['class' => 'form-control', 'id' => 'task_deadline', 'placeholder' => 'Deadline', 'required', 'id' => 'deadline_date']) }}
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="btn btn-primary" onclick="createTask()" id="add-task-btn">
                                    Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

@endsection


@push('scripts')

<script>

    // create task
    function createTask() {
        var form = $('#form-task');
        var formData = form.serialize();
        $.ajax({
            url: '/store_task',
            data: formData,
            type: 'POST',
            beforeSend:function(){
                $('.error-messages').html(' ').addClass('hide');
            },
            success: function (data, status) {
                if(data.success === true){
                    console.log('show data',data);
                    $('.error-messages').html(' ').hide();
                    $('.success-messages').html(data.data.message).show();
                    $("#form-task")[0].reset();
                    $("#tast_title, #task_description, #task_deadline").select2().val(" ");
                } else {
                    $('.error-messages').html(data.data.message).show();
                    $('.success-messages').html(data.data.message).hide();
                }
            }
        });
    }


    // $(document).ready(function() {
    //     $('#taskTable').DataTable({
    //         "scrollX": true
    //     });
    // });







</script>
    
@endpush


