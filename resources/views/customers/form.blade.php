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
                    {{ Form::label('Customer Name') }}
                {{ Form::text('Customer', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Name']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('GenderID','Gender') }}
               {{ Form::select('GenderID', [ '' =>  'Select Gender'] + $genders->pluck('Gender', 'GenderRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('DOB','Date of Birth' ) }}
                {{ Form::date('DOB', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Birthday']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Email', 'Email Address') }}
                {{ Form::text('Email', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Email']) }}
                </div>
            </div>
        </div>
    </div>
    <hr>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('HomeAddress','Home Address') }}
            {{ Form::Textarea('HomeAddress',null, ['class'=> "form-control",'placeholder' => "Enter Customer Home Address"]) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('ShopAddress', 'Shop Address') }}
            {{ Form::textarea('ShopAddress', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Shop Address']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('StateOfOrigin','State of Origin') }}
                {{ Form::text('StateOfOrigin',null, ['class'=> "form-control",'placeholder' => "Enter Customer State of Origin"]) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('LGA','Local Government') }}
                {{ Form::text('LGA',null, ['class'=> "form-control",'placeholder' => "Enter Customer Local Government"]) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('NationalityID', 'Nationality') }}
                {{ Form::select('NationalityID', [ '' =>  'Select Nationality'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('Telephone','Phone Number') }}
                {{ Form::text('Telephone',null, ['class'=> "form-control",'placeholder' => "Enter Customer Phone Number"]) }}
                    </div>
                </div>
            </div>
        </div>
    </hr>
</link>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('MaritalStatusID', 'Marital Status') }}
                {{ Form::select('MaritalStatusID', [ '' =>  'Select Marital Status'] + $maritalstatus->pluck('MaritalStatus', 'MaritalStatusRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Occupation','Occupation' ) }}
                {{ Form::text('Occupation', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Occupation']) }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('MeansOfID_ID', 'Means of Identification') }}
               {{ Form::select('MeansOfID_ID', [ '' =>  'Select Nationality'] + $identities->pluck('Identification', 'Identification')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('CustomerMaidenName','Customer Maiden Name' ) }}
                {{ Form::text('CustomerMaidenName', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Customer Maiden Name']) }}
            </div>
        </div>
    </div>
</div>
<hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('SpouseName', 'Spouse Name') }}
                {{ Form::text('SpouseName', null, ['class' => 'form-control', 'placeholder' => 'Enter Spouse Name']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('SpouseAddress','Customer Spouse Address' ) }}
                {{ Form::text('SpouseAddress', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Spouse Address']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('SpousePhone', 'Spouse Phone') }}
                {{ Form::text('SpousePhone', null, ['class' => 'form-control', 'placeholder' => 'Enter Spouse Phone']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('NextOfKinName','Next of Kin Name' ) }}
                {{ Form::text('NextOfKinName', null, ['class' => 'form-control', 'placeholder' => 'Enter Next Of Kin Name']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('NextOfKinPhone', 'Next Of Kin Phone Number') }}
                {{ Form::text('NextOfKinPhone', null, ['class' => 'form-control', 'placeholder' => 'Enter Next Of Kin Phone Number']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('NextofKinAddress','Next of Kin Address' ) }}
                {{ Form::text('NextofKinAddress', null, ['class' => 'form-control', 'placeholder' => 'Enter Next of Kin Address']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('BVN', 'BVN') }}
                {{ Form::text('BVN', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer BVN']) }}
                </div>
            </div>
        </div>
    </div>
</hr>
<hr>
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
</hr>
