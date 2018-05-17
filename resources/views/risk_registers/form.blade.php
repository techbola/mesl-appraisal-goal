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
                {{ Form::label('RiskDescription', 'Risk Description') }}
                {{ Form::text('RiskDescription', null, ['class' => 'form-control', 'placeholder' => 'E.g Events, Causes, Impacts']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('RelatedObjectives', 'Related Objectives') }}
                {{ Form::text('RelatedObjectives', null, ['class' => 'form-control', 'placeholder' => 'E.g Events, Causes, Impacts']) }}
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('RiskScore', 'Likelihood Of Risk Score') }}
                {{ Form::number('RiskScore', null, ['class' => 'form-control', 'placeholder' => '50']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('RiskTypeID', 'Risk Type') }}
                {{ Form::select('RiskTypeID', [ '' =>  'Select Risk Type'] + $risk_types->pluck('RiskType', 'RiskTypeRef')->toArray(),null, ['class'=> "full-width", 'id' => 'mySelect', 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="controls">
                {!! Form::label('Controls', 'Controls') !!} <small class="help">What is in place to prevent, detect and manage risk?</small>
                {{ Form::textarea('Controls', null, ['class' => 'form-control', 'placeholder' => 'E.g Events, Causes, Impacts']) }}
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('ControlEffectivenessScore', 'Control Effectiveness Score') }}
                {{ Form::number('ControlEffectivenessScore', null, ['class' => 'form-control', 'placeholder' => '50']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('ResidualRiskRating', 'Residual Risk Rating') }}
                {{ Form::select('ResidualRiskRating', [ '' =>  'Select Type'] + $residual_risk_types->pluck('ResidualRiskType', 'ResidualRiskTypeRef')->toArray(),null, ['class'=> "full-width", 'id' => 'rrt', 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('RiskOwner', 'Risk Owner') }} <small class="help">Job Title</small>
                {{ Form::text('RiskOwner', null, ['class' => 'form-control', 'placeholder' => 'E.g ']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('RiskTreatment', 'Risk Treatment') }}
                {{ Form::select('RiskTreatment', [ '' =>  'Select Risk Treatment'] + $risk_treatments->pluck('RiskTreatment', 'RiskTreatmentRef')->toArray(),null, ['class'=> "full-width", 'id' => 'rrt', 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

</div>




<!-- action buttons -->
<div class="row">
    <div class="pull-right">
        {{ Form::hidden('InputterID',auth()->user()->id) }}
        {{ Form::hidden('ModifierID',auth()->user()->id) }}
        {{ Form::submit( $buttonText, [ 'class' => 'btn btn-info' ]) }}
        {{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
    </div>
</div>
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
