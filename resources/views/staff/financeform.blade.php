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
            <label for="">Staff Fullname</label>
            <input type="text" value="{{ $staff->FullName }}" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('GradeLevelID','Grade Level') }}
            {{ Form::select('GradeLevelID', [ 0 =>  'Select  Grade Level For Staff'] + $grades->pluck('GroupDescription', 'GroupRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select  Grade Level For Staff", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('BankName','Bank Name') }}
            {{ Form::select('BankName', [ 0 =>  'Select  Bank Name'] + $banks->pluck('Bank', 'Bank')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Bank Name", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('BankAcctNumber','Bank Account Number') }}
            {{ Form::text('BankAcctNumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff Bank Account Number']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('TaxableBaseID','Tax Base') }}
            {{ Form::select('TaxableBaseID', [ 0 =>  'Select  Tax Base'] + $taxes->pluck('Description', 'TaxableBaseRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Tax Base", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('PFAID','Pension Fund Administrator') }}
            {{ Form::select('PFAID', [ 0 =>  'Select  Pension Fund Administrator'] + $pfa->pluck('PFA', 'PFARef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => " Pension Fund Administrator", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('PensionRSANumber','Pension RSA Number') }}
            {{ Form::text('PensionRSANumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff Pension RSA Number']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('NHFRate','NHF Rate') }}
            {{ Form::text('NHFRate', 0.025,  ['class' => 'form-control', 'placeholder' => 'Enter NHF Rate']) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('NHISRate','NHIS Rate') }}
            {{ Form::text('NHISRate', 0,  ['class' => 'form-control', 'placeholder' => 'Enter NHIS Rate']) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('WHT','WHT') }}
            {{ Form::text('WHT', 0,  ['class' => 'form-control', 'placeholder' => 'Enter WHT']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('PensionRate','Employee Pension Rate') }}
            {{ Form::text('PensionRate', 0.08,  ['class' => 'form-control', 'placeholder' => 'Enter Employee Pension Rate']) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('EmployerPension','Employer Pension Rate') }}
            {{ Form::text('EmployerPension', 0.1,  ['class' => 'form-control', 'placeholder' => 'Enter Employer Pension Rate']) }}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('GrossIncomeReliefRate','Gross Income Relief Rate') }}
            {{ Form::text('GrossIncomeReliefRate', 0.2,  ['class' => 'form-control', 'placeholder' => 'Enter Gross Income Relief Ra']) }}
            </div>
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
