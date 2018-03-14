@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
        textarea {
        max-height: 50px;
        resize: none;
    }
    </style>
    @endpush
@include('errors.list')
<div class="row">

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('AbsenceTypeID','Absence Type') }}
            {{ Form::select('AbsenceTypeID', [ 0 =>  'Absence Type'] + $status->pluck('MaritalStatus', 'MaritalStatusRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Absence Type", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
   


    <!-- action buttons -->
    <div class=" pull-right">
        <div class="form-group">
            <div class="controls">
                <div class="m-t-25">
                </div>
                {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
            </div>
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
