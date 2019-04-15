@extends('layouts.master')

@push('styles')

	<style>
		.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }

    thead tr {
      font-weight: bold;
      color: #000;
    }

    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control, .select2 {
        font-weight: normal !important;
        color: #aaaaaa !important;
        font-family: "Karla", sans-serif !important;
    }

    .form-control{
        font-family: "Karla", sans-serif !important;
    }

    body {
        color: #444;
        background-color: #ebeff2 !important;
        font-size: 14px;
        font-family: "Karla", 'Helvetica Neue', Helvetica, Arial, sans-serif;
        zoom: 99%;
    }


	</style>
@endpush

@section('content')

    <ul class="nav nav-tabs outside">
        <li class="active">
            <a data-toggle="tab" href="#exit-interview">
                Exit Interview &nbsp; <span class="badge badge-warning"></span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#interview-request">
                Submitted Interview &nbsp; <span class="badge badge-success">
                    {{ $exits->count() }}
                </span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="exit-interview" class="tab-pane fade in active">
            <div class="clearfix"></div>
            <div class="card-box">
                <div class="card-title"><strong>Exit Interview Form</strong></div>
                    <br>
                    <form action="{{ route('StoreExitInterview') }}" method="POST" class="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('StaffID','Staff Name') }}
                                    {{ Form::text('', Auth::user()->FullName ?? '', ['class' => 'form-control', 'placeholder' => 'Staff Name', 'required', 'readonly' ]) }}
                                    <input type="hidden" name="StaffID">
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('DepartmentID','Department') }}
                                    <select name="DepartmentID" class="full-width" data-init-plugin="select2" id="department" onchange="">
                                        <option value=" ">Select Department</option>
                                        @foreach($department as $item)
                                            <option value="{{ $item->DepartmentRef }}">{{ $item->Department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('InterviewDate', 'Date Of interview' ) }}
                                    <div class="input-group date dp">
                                        {{ Form::text('InterviewDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Date Of interview', 'required', 'required']) }}
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('ExitReasonID', '1. Reason for Leaving' ) }}
                                        <select name="ExitReasonID" class="full-width" data-init-plugin="select2"  onchange="">
                                            <option value=" ">Select Exit Reason</option>
                                            @foreach($exitreasons as $exitreason)
                                                <option value="{{ $exitreason->ExitReasonRef }}">{{ $exitreason->ExitReason }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('RelocationReasonID', '2. If Relocating please specify reason why' ) }}
                                        <select name="RelocationReasonID" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Relocation Reason</option>
                                            @foreach($relocation as $item)
                                                <option value="{{ $item->RelocationReasonRef }}">{{ $item->RelocationReason }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('ForwardAddress', '3. If applicable, what is your forwarding address' ) }}
                                        <br>
                                        <br>
                                        {{ Form::textarea('ForwardAddress', null, ['class' => 'form-control', 'placeholder' => 'Forwarding Address', 'rows'=> '2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('LeastEmployment', '4. What did you like least about your employment experience at the organization?' ) }}
                                        {{ Form::textarea('LeastEmployment', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkReason', '5. Why did you come to work for this organization?' ) }}
                                        <br>
                                        <br>
                                        {{ Form::textarea('WorkReason', null, ['class' => 'form-control', 'placeholder' => 'Reason for working here', 'rows'=> '2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('MostEmployment', '6. What did you like most about your employment experience at the organization?' ) }}
                                        {{ Form::textarea('MostEmployment', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('EmploymentReasonID', '7. If accepting another employment please indicate your main reason' ) }}
                                        <select name="EmploymentReasonID" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select New employment reason</option>
                                            @foreach($employmentreason as $item)
                                                <option value="{{ $item->EmploymentReasonRef }}">{{ $item->EmploymentReason }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkAgain', '8. Would you consider working here again?' ) }}
                                        <select name="WorkAgain" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('Workrelationship', '9. I have a good working relationship with co-workers' ) }}
                                        <select name="Workrelationship" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('SupervisorRelationship', '10. I had a good working relationship with my supervisor' ) }}
                                        <select name="SupervisorRelationship" class="full-width" data-init-plugin="select2">
                                            <option value="SupervisorRelationship">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('JobExpectations', '11. Training or job development met expectations.' ) }}
                                        <select name="JobExpectations" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkAssignment', '12. Work Assignments were distributed evenly.' ) }}
                                        <select name="WorkAssignment" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('JobUnderstanding', '13. I had a clear understanding of my job duties.' ) }}
                                        <select name="JobUnderstanding" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkConditions', '14. Working conditions met expectations.' ) }}
                                        <select name="WorkConditions" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                            
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkPay', '15. The pay was fair for work required.' ) }}
                                        <select name="WorkPay" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkBenefit', '16. The Benefits were competitive' ) }}
                                        <select name="WorkBenefit" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkSchedule', '17. My work schedule met my needs.' ) }}
                                        <select name="WorkSchedule" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkSatisfaction', '18. Overall, I was satisfied with my job.' ) }}
                                        <select name="WorkSatisfaction" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($option as $item)
                                                <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('WorkComment', '19. Please feel free to comment on any of the areas you have just rated. (Write on the back
                                        if additional space is needed)' ) }}
                                        {{ Form::textarea('WorkComment', null, ['class' => 'form-control', 'placeholder' => 'Comment here', 'rows'=> '2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('ObligationID', '20. Outstanding Obligation' ) }}
                                        <a href="#" data-toggle="tooltip" title="*Please contact the Human Resources Department to confirm status of staff obligation."><i class="fa fa-question-circle"></i></a>
                                        <select name="ObligationID" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select Option</option>
                                            @foreach($obligation as $item)
                                                <option value="{{ $item->ObligationRef }}">{{ $item->Obligation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('PayObligation', '21. How do you intend to pay your outstanding obligation?' ) }}
                                        {{ Form::textarea('PayObligation', null, ['class' => 'form-control', 'placeholder' => 'Comment here', 'rows'=> '2', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <br>
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('HROfficerID', '22. Name Of HR Officer' ) }}
                                        <select name="HROfficerID" class="full-width" data-init-plugin="select2">
                                            <option value=" ">Select HR Officer</option>
                                            @foreach($hr as $item)
                                                <option value="{{ $item->id }}">{{ $item->Fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('ResignedStaff', '23. Name Of Resigned Staff' ) }}
                                        {{ Form::text('ResignedStaff', null, ['class' => 'form-control', 'placeholder' => 'Name here', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <hr>
        
                        <small style="color:red;">*Please contact the Human Resources Department to arrange a time to discuss
                                your benefits as an outgoing employee where applicable.</small>
        
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
            </div>  
        </div>

        <div id="interview-request" class="tab-pane fade">
            <div class="clearfix"></div>
            <div class="card-box">
                <table class="table tableWithSearch table-bordered">
                    <thead>
                        <th width="10%">Staff Name</th>
                        <th width="7%">Department</th>
                        <th width="7%">Date Of Interview</th>
                        <th width="5%">Reason For Leaving</th>
                        <th width="15%">Action</th>
                    </thead>
                    <tbody>
                        @foreach($exits as $exit)
                            @if($exit->SentResponse == false)
                                <tr>
                                    <td>{{$exit->ResignedStaff}}</td>
                                    <td>{{$exit->department->Department}}</td>
                                    <td>{{$exit->InterviewDate}}</td>
                                    <td>{{$exit->exit_reason->ExitReason}}</td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_exitinterview({{$exit->ExitInterviewRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                        <a href="#" onclick="deleteItem('{{$exit->ExitInterviewRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                        <a href="{{ route('SendResponse', $exit->ExitInterviewRef) }}" onclick="" type="button" class="btn btn-xs btn-success toggler"><i class="fa fa-send"></i>Send Response</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>


        {{-- Modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Exit Interview form</strong></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <br>
                    <div class="modal-body">
                        <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="ExitInterviewRef" name="ExitInterviewRef">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('StaffID','Staff Name') }}
                                        {{ Form::text('', Auth::user()->FullName, ['class' => 'form-control', 'placeholder' => 'Staff Name', 'required', 'id' => 'staff_id', 'readonly' ]) }}
                                        <input type="hidden" name="StaffID">
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('DepartmentID','Department') }}
                                        <select name="DepartmentID" class="full-width" data-init-plugin="select2" id="exit_department" >
                                            <option value=" ">Select Department</option>
                                            @foreach($department as $item)
                                                <option value="{{ $item->DepartmentRef }}">{{ $item->Department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('InterviewDate', 'Date Of interview' ) }}
                                        <div class="input-group date dp">
                                            {{ Form::text('InterviewDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Date Of interview', 'required', 'id' => 'interview_date', 'required']) }}
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ExitReasonID', '1. Reason for Leaving' ) }}
                                            <select name="ExitReasonID" class="full-width" data-init-plugin="select2" id="exit_reason" onchange="">
                                                <option value=" ">Select Exit Reason</option>
                                                @foreach($exitreasons as $exitreason)
                                                    <option value="{{ $exitreason->ExitReasonRef }}">{{ $exitreason->ExitReason }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('RelocationReasonID', '2. If Relocating please specify reason why' ) }}
                                            <select name="RelocationReasonID" class="full-width" data-init-plugin="select2" id="relocation_reason">
                                                <option value=" ">Select Relocation Reason</option>
                                                @foreach($relocation as $item)
                                                    <option value="{{ $item->RelocationReasonRef }}">{{ $item->RelocationReason }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ForwardAddress', '3. If applicable, what is your forwarding address' ) }}
                                            <br>
                                            <br>
                                            {{ Form::textarea('ForwardAddress', null, ['class' => 'form-control', 'placeholder' => 'Forwarding Address','id' => 'forward_address', 'rows'=> '2', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('LeastEmployment', '4. What did you like least about your employment experience at the organization?' ) }}
                                            {{ Form::textarea('LeastEmployment', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'id' => 'least_employment', 'rows'=> '2', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkReason', '5. Why did you come to work for this organization?' ) }}
                                            <br>
                                            <br>
                                            {{ Form::textarea('WorkReason', null, ['class' => 'form-control', 'placeholder' => 'Reason for working here','id' => 'work_reason', 'rows'=> '2', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('MostEmployment', '6. What did you like most about your employment experience at the organization?' ) }}
                                            {{ Form::textarea('MostEmployment', null, ['class' => 'form-control', 'placeholder' => 'Expereience here','id' => 'most_employment', 'rows'=> '2', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('EmploymentReasonID', '7. If accepting another employment please indicate your main reason' ) }}
                                            <select name="EmploymentReasonID" class="full-width" data-init-plugin="select2" id="new_emp">
                                                <option value=" ">Select New employment reason</option>
                                                @foreach($employmentreason as $item)
                                                    <option value="{{ $item->EmploymentReasonRef }}">{{ $item->EmploymentReason }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkAgain', '8. Would you consider working here again?' ) }}
                                            <br>
                                            <br>
                                            <select name="WorkAgain" class="full-width" data-init-plugin="select2" id="work_again" onchange="">
                                                <option value=" ">Select Option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('Workrelationship', '9. I have a good working relationship with co-workers' ) }}
                                            <select name="Workrelationship" class="full-width" data-init-plugin="select2" id="work_rel">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('SupervisorRelationship', '10. I had a good working relationship with my supervisor' ) }}
                                            <select name="SupervisorRelationship" class="full-width" data-init-plugin="select2" id="work_sup">
                                                <option value="SupervisorRelationship">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('JobExpectations', '11. Training or job development met expectations.' ) }}
                                            <select name="JobExpectations" class="full-width" data-init-plugin="select2" id="work_pre">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkAssignment', '12. Work Assignments were distributed evenly.' ) }}
                                            <select name="WorkAssignment" class="full-width" data-init-plugin="select2" id="worka">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('JobUnderstanding', '13. I had a clear understanding of my job duties.' ) }}
                                            <select name="JobUnderstanding" class="full-width" data-init-plugin="select2" id="jobu">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkConditions', '14. Working conditions met expectations.' ) }}
                                            <select name="WorkConditions" class="full-width" data-init-plugin="select2" id="work_conditions">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkPay', '15. The pay was fair for work required.' ) }}
                                            <select name="WorkPay" class="full-width" data-init-plugin="select2" id="work_pay">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkBenefit', '16. The Benefits were competitive' ) }}
                                            <select name="WorkBenefit" class="full-width" data-init-plugin="select2" id="work_benefit">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkSchedule', '17. My work schedule met my needs.' ) }}
                                            <select name="WorkSchedule" class="full-width" data-init-plugin="select2" id="work_schedule">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkSatisfaction', '18. Overall, I was satisfied with my job.' ) }}
                                            <select name="WorkSatisfaction" class="full-width" data-init-plugin="select2" id="work_satisfaction">
                                                <option value=" ">Select Option</option>
                                                @foreach($option as $item)
                                                    <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('WorkComment', '19. Please feel free to comment on any of the areas you have just rated. (Write on the back
                                            if additional space is needed)' ) }}
                                            {{ Form::textarea('WorkComment', null, ['class' => 'form-control', 'placeholder' => 'Comment here','id' => 'work_comment', 'rows'=> '2', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ObligationID', '20. Outstanding Obligation' ) }}
                                            <a href="#" data-toggle="tooltip" title="*Please contact the Human Resources Department to confirm status of staff obligation."><i class="fa fa-question-circle"></i></a>
                                            <select name="ObligationID" class="full-width" data-init-plugin="select2" id="obligation_id">
                                                <option value=" ">Select Option</option>
                                                @foreach($obligation as $item)
                                                    <option value="{{ $item->ObligationRef }}">{{ $item->Obligation }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('PayObligation', '21. How do you intend to pay your outstanding obligation?' ) }}
                                            {{ Form::textarea('PayObligation', null, ['class' => 'form-control', 'placeholder' => 'Comment here','id' => 'pay_obligation', 'rows'=> '2', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <br>
            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('HROfficerID', '22. Name Of HR Officer' ) }}
                                            <select name="HROfficerID" class="full-width" data-init-plugin="select2" id="hr_officer">
                                                <option value=" ">Select HR Officer</option>
                                                @foreach($hr as $item)
                                                    <option value="{{ $item->id }}">{{ $item->Fullname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ResignedStaff', '23. Name Of Resigned Staff' ) }}
                                            {{ Form::text('ResignedStaff', null, ['class' => 'form-control', 'placeholder' => 'Name here','id' => 'resigned_staff', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="pull-right">
                                    <button class="btn btn-info" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
    </div>



@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>

    function edit_exitinterview(id) {
        $.get('/edit_exit_interview/'+id, function(data, status) {

        $('#ExitInterviewRef').val(data.ExitInterviewRef);

        $('#staff_id').val(data.StaffID);

        $('#exit_department').val(data.DepartmentID).trigger('change');

        $('#exit_reason').val(data.ExitReasonID).trigger('change');

        $('#relocation_reason').val(data.RelocationReasonID).trigger('change');

        $('#forward_address').val(data.ForwardAddress);

        $('#interview_date').val(data.InterviewDate);

        $('#least_employment').val(data.LeastEmployment);

        $('#work_reason').val(data.WorkReason);

        $('#most_employment').val(data.MostEmployment);

        $('#new_emp').val(data.EmploymentReasonID).trigger('change');

        $('#work_again').val(data.WorkAgain).trigger('change');

        $('#work_rel').val(data.WorkRelationship).trigger('change');

        $('#work_sup').val(data.SupervisorRelationship).trigger('change');

        $('#work_pre').val(data.JobExpectations).trigger('change');

        $('#worka').val(data.WorkAssignment).trigger('change');

        $('#jobu').val(data.JobUnderstanding).trigger('change');

        $('#work_conditions').val(data.WorkConditions).trigger('change');

        $('#work_pay').val(data.WorkPay).trigger('change');

        $('#work_benefit').val(data.WorkBenefit).trigger('change');

        $('#work_schedule').val(data.WorkSchedule).trigger('change');

        $('#work_satisfaction').val(data.WorkSatisfaction).trigger('change');
        
        $('#work_comment').val(data.WorkComment);

        $('#obligation_id').val(data.ObligationID).trigger('change');

        $('#pay_obligation').val(data.PayObligation);

        $('#hr_officer').val(data.HROfficerID).trigger('change');

        $('#resigned_staff').val(data.ResignedStaff);

        $('#form-edit').prop('action', '/update_exit_interview');
                
        });
    }

    // what to delete btn
    function deleteItem(ExitInterviewRef){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result == true){
                window.location.href = "/exit/create/"+ExitInterviewRef;
            }
        })
    }

    //send interview
    function sendItem(ExitInerviewRef){
        swal({
            title: 'Are you sure?',
            text: "You might not be able to make Changes again!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Send it!'
        }).then((result) => {
            if(result == true){
                window.location.href = "//"+ExitInterviewRef;
            }
        })
    }



</script>

@endpush