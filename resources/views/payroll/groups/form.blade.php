<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('Scenario','Payroll Percentages') }}
            {{ Form::select('Scenario', [ null =>  'Payroll Level'] + $payroll_levels->pluck('Scenario', 'ScenarioRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Payroll Level", 'data-init-plugin' => "select2"]) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('BaseAmount','Base Amount') }}
            {{ Form::text('BaseAmount', null, ['class'=> "form-control smartinput",'placeholder' => 'E.g 20000.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('GroupDescription','Group Description') }}
            {{ Form::text('GroupDescription', null, ['class'=> "form-control", 'placeholder' => 'E.g Cavidel Intern Employee']) }}
        </div>
</div>

<!-- Toggler based on Payroll Level -->

<div id="payroll_level_toggler_wrapper">
<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('STIRate','STI Rate') }}
            {{ Form::text('STIRate', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Basic','Basic') }}
            {{ Form::text('Basic', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Housing','Housing') }}
            {{ Form::text('Housing', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>

<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('Transport','Transport') }}
            {{ Form::text('Transport', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Utilities','Utilities') }}
            {{ Form::text('Utilities', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Leave','Leave') }}
            {{ Form::text('Leave', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>

<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('MealSubsidy','Meal Subsidy') }}
            {{ Form::text('MealSubsidy', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Reimbursibles','Reimbursibles') }}
            {{ Form::text('Reimbursibles', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Medicals','Medicals') }}
            {{ Form::text('Medicals', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>

<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('Furniture','Furniture') }}
            {{ Form::text('Furniture', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Dressing','Dressing') }}
            {{ Form::text('Dressing', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('CarMaintenance','Car Maintenance') }}
            {{ Form::text('CarMaintenance', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>


<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('OtherAllowance','Other Allowance') }}
            {{ Form::text('OtherAllowance', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Drivers','Drivers') }}
            {{ Form::text('Drivers', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Travel','Travel') }}
            {{ Form::text('Travel', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>

<div class="row">
        <div class="form-group col-sm-4">
            {{ Form::label('ClubandProfessional','Club and Professional') }}
            {{ Form::text('ClubandProfessional', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Bonus13thMonth','Bonus 13th Month') }}
            {{ Form::text('Bonus13thMonth', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('ProductivityBonus','Productivity Bonus') }}
            {{ Form::text('ProductivityBonus', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>

</div>
<!-- End Toggler -->

{{-- <h4>Deductions</h4> --}} <hr>

<div class="row">

        <div class="form-group col-sm-4">
            {{ Form::label('GradeLevel','Level') }} <!-- considered to be roles -->
            {{ Form::select('GradeLevel', [ null =>  'Seniority Level'] + $seniority_levels->pluck('GradeLevel', 'SeniorityRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Seniority Level", 'data-init-plugin' => "select2"]) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('LifeAssurance','Life Assurance') }}
            {{ Form::text('LifeAssurance', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>

        <div class="form-group col-sm-4">
            {{ Form::label('Welfare','Welfare') }}
            {{ Form::text('Welfare', null, ['class'=> "form-control smartinput", 'placeholder' => '0.00']) }}
        </div>
</div>

@push('scripts')
    <script>
        $(function(){
            var payroll_level_toggler_wrapper = $("#payroll_level_toggler_wrapper");
            $("#Scenario").val() == 6 ? payroll_level_toggler_wrapper.addClass('hide') : payroll_level_toggler_wrapper.removeClass('hide');

            $("#Scenario").change(function(e) {
                e.preventDefault();
                $(this).val() == 6 ? payroll_level_toggler_wrapper.addClass('hide') : payroll_level_toggler_wrapper.removeClass('hide')
            });
        });
    </script>
@endpush
