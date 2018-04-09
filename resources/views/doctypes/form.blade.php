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
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('DocType', 'Document Type ') }}
                        {{ Form::text('DocType', null, ['class' => 'form-control', 'placeholder' => 'Enter Document Type']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    <div class="m-t-25">
                    </div>
                    {{ Form::hidden('InputterID',auth()->user()->id) }}
                    {{ Form::hidden('ModifierID',auth()->user()->id) }}
                     {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
                </div>
            </div>
        </div>
    </div>
    <br>
        <br>
        </br>
    </br>
</link>
@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        };
         $('.dp').datepicker({autoclose:true});
    })
</script>
@endpush
