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


    /* table th, table td {
        width: 80px  !important;
    } */
	</style>
@endpush

@section('content')

    <div class="card-box">
        <div class="card-title"><strong>Exit Interview Form</strong></div>
        <br>
        <form action="{{ route('StoreExitInterview') }}" method="POST" class="form">
                {{ csrf_field() }}

                {{-- row1 --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('StaffID','Staff Name') }}
                            {{ Form::text('', Auth::user()->FullName, ['class' => 'form-control', 'placeholder' => 'Staff Name', 'required', 'readonly' ]) }}
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
                                {{ Form::text('InterviewDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Date Of interview', 'required', 'id' => 'interview_Date', 'required']) }}
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                {{-- row2 --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('ExitReasonID', 'Reason for Leaving' ) }}
                                <select name="ExitReasonID" class="full-width" data-init-plugin="select2" id="exit_reason" onchange="">
                                    <option value=" ">Select Exit Reason</option>
                                    @foreach($exitreasons as $exitreason)
                                        <option value="{{ $exitreason->ExitReasonRef }}">{{ $exitreason->ExitReason }}</option>
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
                                {{ Form::label('ExitReasonID', 'If Relocating please specify reason why' ) }}
                                <select name="ExitReasonID" class="full-width" data-init-plugin="select2" id="relocation_reason" onchange="">
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('ForwardAddress', 'If applicable, what is your forwarding address' ) }}
                                {{ Form::textarea('ForwardAddress', null, ['class' => 'form-control', 'placeholder' => 'Forwarding Address', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                {{-- row3 --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('LeastEmployment', 'What did you like least about your employment experience at the organization?' ) }}
                                {{ Form::textarea('LeastEmployment', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                    <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkReason', 'Why did you come to work for this organization?' ) }}
                                {{ Form::textarea('WorkReason', null, ['class' => 'form-control', 'placeholder' => 'Reason for working here', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('MostEmployment', 'What did you like most about your employment experience at the organization?' ) }}
                                {{ Form::textarea('MostEmployment', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                {{-- row4 --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('EmploymentReasonID', 'If accepting another employment please indicate your main reason' ) }}
                                <select name="EmploymentReasonID" class="full-width" data-init-plugin="select2" id="new_emp" onchange="">
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
                                {{ Form::label('WorkAgain', 'Would you consider working here again?' ) }}
                                <select name="WorkAgain" class="full-width" data-init-plugin="select2" id="emp_again" onchange="">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('Workrelationship', 'I have a good working relationship with co-workers' ) }}
                                <select name="Workrelationship" class="full-width" data-init-plugin="select2" id="work_rel" onchange="">
                                    <option value=" ">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('SupervisorRelationship', 'I had a good working relationship with my supervisor' ) }}
                                <select name="SupervisorRelationship" class="full-width" data-init-plugin="select2" id="work_sup" onchange="">
                                    <option value="SupervisorRelationship">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('JobExpectations', 'Training or job development met expectations.' ) }}
                                <select name="JobExpectations" class="full-width" data-init-plugin="select2" id="work_pre" onchange="">
                                    <option value=" ">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkAssignemnt', 'Work Assignments were distributed evenly.' ) }}
                                <select name="WorkAssignemnt" class="full-width" data-init-plugin="select2" id="worka" onchange="">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('JobUnderstanding', ' I had a clear understanding of my job duties.' ) }}
                                <select name="JobUnderstanding" class="full-width" data-init-plugin="select2" id="jobu" onchange="">
                                    <option value=" ">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkConditions', ' Working conditions met expectations.' ) }}
                                <select name="WorkConditions" class="full-width" data-init-plugin="select2" id="expectations" onchange="">
                                    <option value=" ">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkPay', 'The pay was fair for work required.' ) }}
                                <select name="WorkPay" class="full-width" data-init-plugin="select2" id="work_pay" onchange="">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkBenefit', 'The Benefits were competitive' ) }}
                                <select name="WorkBenefit" class="full-width" data-init-plugin="select2" id="work_benefits" onchange="">
                                    <option value=" ">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkSchedule', 'My work schedule met my needs.' ) }}
                                <select name="WorkSchedule" class="full-width" data-init-plugin="select2" id="work_needs" onchange="">
                                    <option value=" ">Select Option</option>
                                    @foreach($option as $item)
                                        <option value="{{ $item->OptionsRef }}">{{ $item->Options }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkSatisfaction', 'Overall, I was satisfied with my job.' ) }}
                                <select name="WorkSatisfaction" class="full-width" data-init-plugin="select2" id="work_satisfied" onchange="">
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
                                {{ Form::label('WorkComment', 'Please feel free to comment on any of the areas you have just rated. (Write on the back
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
                                {{ Form::label('ObligationID', 'Outstanding Obligation' ) }}
                                <a href="#" data-toggle="tooltip" title="*Please contact the Human Resources Department to confirm status of staff obligation."><i class="fa fa-question-circle"></i></a>
                                <select name="ObligationID" class="full-width" data-init-plugin="select2" id="work_obligation" onchange="">
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
                                {{ Form::label('PayObligation', 'How do you intend to pay your outstanding obligation?' ) }}
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
                                {{ Form::label('HROfficerID', 'Name Of HR Officer' ) }}
                                <select name="HROfficerID" class="full-width" data-init-plugin="select2" id="hr_officer" onchange="">
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
                                {{ Form::label('ResignedStaff', 'Name Of Resigned Staff' ) }}
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



@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>




@endpush