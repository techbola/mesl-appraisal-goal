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

    /* table th, table td {
        width: 80px  !important;
    } */
	</style>
@endpush

@section('content')

    <div class="card-box">
        <div class="card-title"><strong>Exit Interview Form</strong></div>
        <br>
            <form action="" class="form">
                {{ csrf_field() }}

                {{-- row1 --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('StaffName','Staff Name') }}
                            {{ Form::text('StaffName', null, ['class' => 'form-control', 'placeholder' => 'Staff Name', 'required' ]) }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('Department','Department') }}
                            {{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Department', 'required' ]) }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ResumptionDate', 'Date Of interview' ) }}
                            <div class="input-group date dp">
                                {{ Form::text('ResumptionDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Date Of interview', 'required', 'id' => 'resumption_Date', 'required']) }}
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                {{-- row2 --}}
                <div class="row">
                    <div class="col-md-4">
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

                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('ForwardingAddress', 'If applicable, what is your forwarding address' ) }}
                                {{ Form::textarea('ForwardingAddress', null, ['class' => 'form-control', 'placeholder' => 'Forwarding Address', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                {{-- row3 --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('LeastLiked', 'What did you like least about your employment experience at the organization?' ) }}
                                {{ Form::textarea('LeastLiked', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkReason', 'Why did you come to work for this organization?' ) }}
                                {{ Form::textarea('WorkReason', null, ['class' => 'form-control', 'placeholder' => 'Reason for working here', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('MostLiked', 'What did you like most about your employment experience at the organization?' ) }}
                                {{ Form::textarea('MostLiked', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2', 'required']) }}
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
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('Worksup', 'I had a good working relationship with my supervisor' ) }}
                                <select name="Worksup" class="full-width" data-init-plugin="select2" id="work_sup" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('Worktrain', 'Training or job development met expectations.' ) }}
                                <select name="WorkTrain" class="full-width" data-init-plugin="select2" id="work_sup" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('Worka', 'Work Assignments were distributed evenly.' ) }}
                                <select name="Worka" class="full-width" data-init-plugin="select2" id="worka" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
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
                                {{ Form::label('duties', ' I had a clear understanding of my job duties.' ) }}
                                <select name="duties" class="full-width" data-init-plugin="select2" id="duties" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('workexp', ' Working conditions met expectations.' ) }}
                                <select name="workexp" class="full-width" data-init-plugin="select2" id="expectations" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('workpay', 'The pay was fair for work required.' ) }}
                                <select name="workpay" class="full-width" data-init-plugin="select2" id="work_pay" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
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
                                {{ Form::label('benefits', 'The Benefits were competitive' ) }}
                                <select name="benefits" class="full-width" data-init-plugin="select2" id="work_benefits" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('needs', 'My work schedule met my needs.' ) }}
                                <select name="needs" class="full-width" data-init-plugin="select2" id="work_needs" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('satisfied', 'Overall, I was satisfied with my job.' ) }}
                                <select name="satisfied" class="full-width" data-init-plugin="select2" id="work_satisfied" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="Strongly Agree">Strongly Agree</option>
                                    <option value="Agree">Agree</option>
                                    <option value="Disagree">Disagree</option>
                                    <option value="Strongly Disagree">Strongly Disagree</option>
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
                                {{ Form::label('Comment', 'Please feel free to comment on any of the areas you have just rated. (Write on the back
                                if additional space is needed)' ) }}
                                {{ Form::textarea('Comment', null, ['class' => 'form-control', 'placeholder' => 'Comment here', 'rows'=> '2', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('Obligation', 'Outstanding Obligation' ) }}
                                <a href="#" data-toggle="tooltip" title="*Please contact the Human Resources Department to confirm status of staff obligation."><i class="fa fa-question-circle"></i></a>
                                <select name="Obligation" class="full-width" data-init-plugin="select2" id="work_obligation" onchange="">
                                    <option value=" ">Select Option</option>
                                    <option value="In lieu of notice:">In lieu of notice:</option>
                                    <option value="Status Car:">Status Car:</option>
                                    <option value="Official Laptop:">Official Laptop:</option>
                                    <option value="Other allowances:">Other allowances:</option>
                                    <option value="Not Applicable:">Not Applicable:</option>
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
                                {{ Form::label('HRofficer', 'Name Of HR Officer' ) }}
                                {{ Form::text('HRofficer', null, ['class' => 'form-control', 'placeholder' => 'Name here', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('StaffName', 'Name Of Resigned Staff' ) }}
                                {{ Form::text('StaffName', null, ['class' => 'form-control', 'placeholder' => 'Name here', 'required']) }}
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