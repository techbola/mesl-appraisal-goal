@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
    @include('errors.list')
    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('request_type_id', 'Request Type') }}<span style="padding: 0 !important" class="form-add-more add-req badge badge-success " data-toggle="modal" data-target="req_setup"><i style="    line-height: 17px;" class="fa fa-plus"></i></span>
                    {{ Form::select('request_type_id', ['' => 'Select Request Type'] + $request_types->pluck('name','id')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request Type']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">

                    {{ Form::label('recipients', 'To') }}
                    {{ Form::select('recipients[]',$employees->pluck('FullName', 'UserID'),  isset($memo) ? collect($memo->recipients)->toArray() : null , ['class' => 'form-control', 'multiple', 'data-placeholder' => 'Select Approver']) }}
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
        <div class="clearfix"></div>
        <div class="col-sm-12">
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
                    {{ Form::select('ApproverID1', [0 => 'Select Approver'] + $employees->pluck('FullName', 'UserID')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID2', 'Approver 2') }}
                    {{ Form::select('ApproverID2', [0 => 'Select Approver'] + $employees->pluck('FullName', 'UserID')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID3', 'Approver 3') }}
                    {{ Form::select('ApproverID3', [0 => 'Select Approver'] + $employees->pluck('FullName', 'UserID')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ApproverID4', 'Approver 4') }}
                    {{ Form::select('ApproverID4', [0 => 'Select Approver'] + $employees->pluck('FullName', 'UserID')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Approver']) }}
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
    {{-- <select class="js-data-example-ajax"></select> --}}
    <script>
        $(function(){
			$('.dp').datepicker();

            // $("#selUser").select2({
            //   ajax: { 
            //    url: "/employee-list",
            //    type: "get",
            //    dataType: 'json',
            //    delay: 250,
            //    data: function (params) {
            //     return {
            //       searchTerm: params.term // search term
            //     };
            //    },
            //    processResults: function (response) {
            //      return {
            //         results: response
            //      };
            //    },
            //    cache: true
            //   }
            //  });
		})        
    </script>
    @endpush


</link>