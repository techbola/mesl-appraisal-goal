@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
    @include('errors.list')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('request_type_id', 'Request Type') }}
                    {{ Form::select('request_type_id', ['' => 'Select Request Type'] + $request_types->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request Type']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('receiver_id', 'To') }}
                    {{ Form::select('receiver_id', ['' => 'Select Approver'] + $employees->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('subject', 'Subject') }}
                    {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'e.g Leave Approver Reminder']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('purpose', 'Purpose') }}
                    {{ Form::textarea('purpose', null, ['class' => 'form-control','rows' => 3, 'placeholder' => 'Purpose of this memo']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('body', 'Body') }}
                    {{ Form::textarea('body', null, ['class' => 'summernote form-control','rows' => 3, 'placeholder' => 'Be expressive']) }}
                </div>
            </div>
        </div> 
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('memo_attachment[]', 'Attach Files') }}
                    {{ Form::file('memo_attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
        </div> 
    </div>

<hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID1', 'Approver 1') }}
                    {{ Form::select('ApproverID1', ['' => 'Select Approver'] + $employees->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID2', 'Approver 2') }}
                    {{ Form::select('ApproverID2', ['' => 'Select Approver'] + $employees->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID3', 'Approver 3') }}
                    {{ Form::select('ApproverID3', ['' => 'Select Approver'] + $employees->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID4', 'Approver 4') }}
                    {{ Form::select('ApproverID4', ['' => 'Select Approver'] + $employees->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- action buttons -->
    <div class="row">
        <div class="pull-right">
            {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
				{{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $(function(){
			$('.dp').datepicker();
		})        
    </script>
    @endpush
</link>