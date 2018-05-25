@push('styles')

@endpush

@include('errors.list')
<div class="row">

  {{-- {{ dd($staff->PhotographLocation->default_url) }} --}}
    <div class="col-sm-12">
      <div class="inline-block">

        <img src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" alt="" class="inline-block" style="height:100px; width:100px; border-radius:50px; padding:2px; border:1px solid #ccc">
      </div>

      <div class="form-group m-t-10 inline-block m-l-10" style="max-width:50%; vertical-align:middle">
          {{ Form::label('avatar','Upload Profile Picture') }}
          {{ Form::file('avatar',  ["class" => "filestyle form-group", 'data-placeholder' => 'Upload Profile Photo', 'data-buttonname'=>'btn-info', 'data-buttonBefore'=>'true', 'style'=>'border-radius:50px']) }}
          {{-- <input type="file" class="filestyle" name="Photo" data-placeholder="Upload Photo" data-buttonname="btn-info" data-buttonBefore="true"> --}}
      </div>
    </div>
</div>
<div class="clearfix"></div>
<br>

<div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        {{ Form::label('FirstName','First Name') }}
        {{ Form::text('FirstName', $staff->FirstName,  ['class' => 'form-control', 'placeholder' => 'First name']) }}
        {{-- <input type="text" value="{{ $staff->FullName }}" class="form-control" readonly> --}}
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        {{ Form::label('MiddleName','Middle Name') }}
        {{ Form::text('MiddleName', $staff->MiddleName,  ['class' => 'form-control', 'placeholder' => 'Middle name']) }}
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        {{ Form::label('LastName','Last Name') }}
        {{ Form::text('LastName', $staff->LastName,  ['class' => 'form-control', 'placeholder' => 'Last name']) }}
      </div>
    </div>
    @if (auth()->user()->hasRole('admin'))
      <div class="col-sm-3">
        <div class="form-group">
          <label class="req">Role</label>
          {{ Form::select('role', [ '' =>  'Select Role'] + $roles->pluck('name', 'id')->toArray(), $role->pluck('id'), ['class'=> "form-control select2", 'data-init-plugin' => "select2", "required"]) }}
        </div>
      </div>
    @endif
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('PersonalEmail','Personal Email') }}
            {{ Form::email('PersonalEmail', null,  ['class' => 'form-control', 'placeholder' => 'Enter Personal Email']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('DateofBirth','Date of Birth') }}
            <div class="input-group date dp">
                {{ Form::text('DateofBirth', null, ['class' => 'form-control', 'placeholder' => 'Date of Birth']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('HomePhone','Home Phone Number') }}
            {{ Form::text('HomePhone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Home Phone Number']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('MobilePhone','Mobile Phone') }}
            {{ Form::text('MobilePhone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Mobile PhoneNumber']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('WorkPhone','Work Phone Number') }}
            {{ Form::text('WorkPhone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Work Phone Number']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('ReligionID','Religion') }}
             {{ Form::select('ReligionID', [ 0 =>  'Select your religion'] + $religions->pluck('Religion', 'ReligionRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Religion", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('MaritalStatusID','Marital Status') }}
            {{ Form::select('MaritalStatusID', [ 0 =>  'Marital Status'] + $status->pluck('MaritalStatus', 'MaritalStatusRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Marital Status", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('NoofChildren','No of Children') }}
            {{ Form::number('NoofChildren', 0,  ['class' => 'form-control', 'placeholder' => 'Enter No of Children']) }}
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('TownCity','Town / City') }}
            {{ Form::text('TownCity', null,  ['class' => 'form-control', 'placeholder' => 'Enter Town']) }}
        </div>
    </div>

  </div>

  <div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('StateID','State') }}
            {{ Form::select('StateID', [ '' =>  'Select State'] + $states->pluck('State', 'StateRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your State", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('CountryID','Country') }}
            {{ Form::select('CountryID', [ '' =>  'Select Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Country", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    {{-- <div class="clearfix"></div> --}}
  </div>
  <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('AddressLine1','Address1') }}
            {{ Form::textarea('AddressLine1', null,  ['class' => 'form-control', 'rows'=>'2', 'placeholder' => 'Enter Address1']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('AddressLine2','Address2') }}
            {{ Form::textarea('AddressLine2', null,  ['class' => 'form-control', 'rows'=>'2', 'placeholder' => 'Enter Address2']) }}
        </div>
    </div>
  </div>

  <div class="row">

@if ($user->hasRole('admin'))

    <div class="card-section p-l-5">HMO Details</div>

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('HMOID','Health Maintainace Organisation (HMO)') }}
             {{ Form::select('HMOID', [ 0 =>  'Select your HMO'] + $hmos->pluck('HMO', 'HMORef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select your HMO", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('HMOPlanID','Health Maintainace Organisation Plan') }}
             {{ Form::select('HMOPlanID', [ 0 =>  'Select your HMO Plan'] + $hmoplans->pluck('HMOPlan', 'HMOPlanRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select your HMO Plan", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('HMONumber','HMO Number') }}
            {{ Form::text('HMONumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter HMO Number']) }}
        </div>
    </div><div class="clearfix"></div>

  @endif

    <div class="card-section p-l-5">Next of Kin & Beneficiary Details</div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('NextofKIN','Next of KIN') }}
            {{ Form::text('NextofKIN', null,  ['class' => 'form-control', 'placeholder' => 'Enter Name of Next of KIN']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('NextofKIN_Phone','Next of Kin Phone Number') }}
            {{ Form::text('NextofKIN_Phone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Next of Kin Phone Number']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('NextofKIN_Email','Next of Kin Email') }}
            {{ Form::text('NextofKIN_Email', null,  ['class' => 'form-control', 'placeholder' => 'Enter Next of Kin Email']) }}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {{ Form::label('NextofKIN_Address','Next of Kin Address') }}
            {{ Form::textarea('NextofKIN_Address', null,  ['class' => 'form-control', 'rows'=>'2', 'placeholder' => 'Enter Next of Kin Address']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('Beneficiary','Beneficiary Name') }}
            {{ Form::text('Beneficiary', null,  ['class' => 'form-control', 'placeholder' => 'Enter Beneficiary Name']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('Beneficiary_Phone','Beneficiary Phone Number') }}
            {{ Form::text('Beneficiary_Phone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Beneficiary Phone Number']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('Beneficiary_Email','Beneficiary Email Address') }}
            {{ Form::text('Beneficiary_Email', null,  ['class' => 'form-control', 'placeholder' => 'Enter Beneficiary Email Address']) }}
        </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        {{ Form::label('Benficiary_Address','Benficiary Address') }}
        {{ Form::textarea('Benficiary_Address', null,  ['class' => 'form-control', 'rows'=>'2', 'placeholder' => 'Enter Benficiary Address']) }}
      </div>
    </div>
    @if($user->hasRole('admin'))
    <div class="card-section p-l-5">Payroll Details</div>
    <div class="col-sm-12">
      <div class="form-group">
        {{ Form::label('PayrollGroupID','Payroll Group') }}
        {{ Form::select('PayrollGroupID', [ 0 =>  'Select a payroll group'] + $payroll_groups->pluck('GroupDescription', 'GroupRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Religion", 'data-init-plugin' => "select2"]) }}
      </div>
    </div>
    @endif

  </div>

  <!-- action buttons -->
  <div class="form-group">
    <div class="m-t-25">
      {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
    </div>
  </div>

@push('scripts')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

  <script>
  $(function(){
      var options = {
          todayHighlight: true,
          format: 'yyyy-mm-dd',
          autoclose: true,
      };
      $('.dp').datepicker(options);
  });
  </script>
@endpush
