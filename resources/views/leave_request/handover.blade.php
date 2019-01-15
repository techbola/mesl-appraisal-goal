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
            {{-- Row 2 --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('ReliefOfficerID','Relieved By') }}
                        {{ Form::select('ReliefOfficerID', [ '' =>  'Releif Officer'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Relieved By", 'data-init-plugin' => "select2"]) }}
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
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Task(s)</th>
                <th scope="col">Description</th>
                <th scope="col">Deadline</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                </tr>
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
                <form action="" class="form-task">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('Task', 'Create task' ) }}
                                    {{ Form::text('Task', null, ['class' => 'form-control', 'placeholder' => 'Create task', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('Desceiption', 'Task Description' ) }}
                                    {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Explain the task in detail....', 'rows' => '4', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('DeadlineDate', 'Deadline' ) }}
                                <div class="input-group date dp">
                                    {{ Form::text('DeadlineDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Deadline', 'required', 'id' => 'deadline_date']) }}
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

@endsection


