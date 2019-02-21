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
                                {{ Form::text('ResumptionDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Date Of interview', 'required', 'id' => 'resumption_Date']) }}
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
                                {{ Form::label('ExitReasons', 'Reason for Leaving' ) }}
                                <select name="ExitReasons" class="full-width" data-init-plugin="select2" id="exit_reason" onchange="">
                                    <option value=" ">Select Exit Reason</option>
                                    <option value="Unhappy with the Organization">Unhappy with the Organization</option>
                                    <option value="Health Concerns">Health Concerns</option>
                                    <option value="Personal Reasons">Personal Reasons</option>
                                    <option value="Continuing Education">Continuing Education</option>
                                    <option value="Family Needs/Responsibilites">Family Needs/Responsibilites</option>
                                    <option value="Retirement">Retirement</option>
                                    <option value="Relocation">Relocation</option>
                                    <option value="Pay Package">Pay Package</option>
                                    <option value="Present Supervisor">Present Supervisor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('ExitReasons', 'If Relocating please specify reason why' ) }}
                                <select name="ExitReasons" class="full-width" data-init-plugin="select2" id="exit_reloc" onchange="">
                                    <option value=" ">Select Relocation Reason</option>
                                    <option value="Accepting another employment">Accepting another employment</option>
                                    <option value="Relocating with spouse">Relocating with spouse</option>
                                    <option value="Moving closer to family">Moving closer to family</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('ForwardingAddress', 'If applicable, what is your forwarding address' ) }}
                                {{ Form::textarea('ForwardingAddress', null, ['class' => 'form-control', 'placeholder' => 'Forwarding Address', 'rows'=> '2']) }}
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
                                {{ Form::label('NewEmployment', 'If accepting another employment please indicate your main reason' ) }}
                                <select name="NewEmployment" class="full-width" data-init-plugin="select2" id="new_emp" onchange="">
                                    <option value=" ">Select New empployment reason</option>
                                    <option value="Promotion / Career advancement">Promotion / Career advancement</option>
                                    <option value="Distance to / From work">Distance to / From work</option>
                                    <option value="Work Schedule">Work Schedule</option>
                                    <option value="Better benefits">Better benefits</option>
                                    <option value="Career change">Career change</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('WorkReason', 'Why did you come to work for this organization?' ) }}
                                {{ Form::textarea('WorkReason', null, ['class' => 'form-control', 'placeholder' => 'Reason for working here', 'rows'=> '2']) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('MostLiked', 'What did you like most about your employment experience at the organization?' ) }}
                                {{ Form::textarea('MostLiked', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2']) }}
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
                                {{ Form::label('LeastLiked', 'What did you like least about your employment experience at the organization?' ) }}
                                {{ Form::textarea('LeastLiked', null, ['class' => 'form-control', 'placeholder' => 'Expereience here', 'rows'=> '2']) }}
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

            </form>

    </div>



@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>




@endpush