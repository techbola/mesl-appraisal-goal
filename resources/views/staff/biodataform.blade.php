@push('styles')

@endpush

@include('errors.list')
<div class="row">

  {{-- {{ dd($staff->PhotographLocation->default_url) }} --}}
    <div class="col-sm-12">
      <div class="inline-block">

        <img src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" alt="" class="inline-block avatar2" style="height:100px; width:100px; padding:2px; border:1px solid #ccc">
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
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('FirstName','First Name') }}
        {{ Form::text('FirstName', $staff->FirstName,  ['class' => 'form-control', 'placeholder' => 'First name','required']) }}
        {{-- <input type="text" value="{{ $staff->FullName }}" class="form-control" readonly> --}}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('MiddleName','Middle Name') }}
        {{ Form::text('MiddleName', $staff->MiddleName,  ['class' => 'form-control', 'placeholder' => 'Middle name']) }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('LastName','Last Name') }}
        {{ Form::text('LastName', $staff->LastName,  ['class' => 'form-control', 'placeholder' => 'Last name','required']) }}
      </div>
    </div>
</div>
<div class="row">
    @if (auth()->user()->hasRole('admin'))
      <div class="col-sm-6">
        <div class="form-group">
          <label class="req">Roles</label>
          {{ Form::select('roles[]', $roles->pluck('name', 'id')->toArray(), $role->pluck('id'), ['class'=> "form-control select2", 'data-init-plugin' => "select2", "required", "multiple"]) }}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group required">
          <label>Departments</label>
          {{-- <span class="help">Type an email, then press enter or comma.</span> --}}
          {{-- <input name="DepartmentID" class="tagsinput custom-tag-input" type="text" value="" placeholder="."/> --}}

          <select class="form-control select2" name="DepartmentID" data-init-plugin="select2">
            <option value="">Select Department</option>
            @foreach ($departments as $dept)
              <option value="{{ $dept->id }}" @if($dept->id == $staff->DepartmentID) selected @endif>{{ $dept->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
</div>
<div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Supervisor</label>
          {{ Form::select('SupervisorID', [ '' =>  'Select Supervisor'] + $supervisors->pluck('FullName', 'StaffRef')->toArray(), $staff->SupervisorID, ['class'=> "form-control select2", 'data-init-plugin' => "select2", "required"]) }}
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
            {{ Form::label('IDNumber','ID Number') }}
            {{ Form::number('IDNumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter ID Number']) }}
        </div>
    </div>

  </div>
  <div class="row">

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('GenderID','Gender') }}
            {{ Form::select('GenderID', [ '' =>  'Choose Gender'] + $genders->pluck('Gender', 'GenderRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose your Gender", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="">
          {{ Form::label('EmploymentDate','Employment Date', ['class' => 'form-label']) }}
          <div class="input-group date dp required req">
            {{ Form::text('EmploymentDate', null, ['class' => 'form-control', 'placeholder' => 'Employment Date', 'required']) }}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="">
          {{ Form::label('ConfirmationDate','Confirmation Date', ['class' => 'form-label']) }}
          <div class="input-group date dp">
            {{ Form::text('ConfirmationDate', null, ['class' => 'form-control', 'placeholder' => 'Confirmation Date']) }}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="">
          {{ Form::label('DateofBirth','Date of Birth', ['class' => 'form-label']) }}
          <div class="input-group date dp required req">
            {{ Form::text('DateofBirth', null, ['class' => 'form-control required', 'placeholder' => 'Date of Birth', 'required']) }}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
    </div>



    <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('HomePhone','Home Phone Number') }}
            {{ Form::text('HomePhone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Home Phone Number']) }}
        </div>
    </div>

      <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('CityOfBirth','Town/City') }}
            {{ Form::text('CityOfBirth', null,  ['class' => 'form-control required', 'placeholder' => 'Enter City', 'required']) }}
        </div>
    </div>

    {{-- <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('StateOfBirth','State Of Birth') }}
            {{ Form::select('StateOfBirth', [ '' =>  'Select State'] + $states->pluck('State', 'StateRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose your State", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div> --}}

    <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('CountryOfBirth','Country Of Birth') }}
            {{ Form::select('CountryOfBirth', [ '' =>  'Select Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose your Country", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div>

    {{-- <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('CityOfOrigin','City Of Origin') }}
            {{ Form::text('CityOfOrigin', null,  ['class' => 'form-control required', 'placeholder' => 'Enter City of Origin', 'required']) }}
        </div>
    </div> --}}

    {{-- <div class="clearfix"></div> --}}

    <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('StateofOrigin','State Of Origin') }}
            {{ Form::select('StateofOrigin', [ '' =>  'Select State'] + $states->pluck('State', 'StateRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose your State", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div>

    {{-- <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('CountryOfOrigin','Country Of Origin') }}
            {{ Form::select('CountryOfOrigin', [ '' =>  'Select Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose your Country", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div> --}}

    <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('NationalityOfOrigin','Nationality') }}
            {{ Form::text('NationalityOfOrigin', null,  ['class' => 'form-control ', 'placeholder' => 'Enter Nationality', '']) }}
        </div>
    </div>

<div class="clearfix"></div>

    <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('MobilePhone','Mobile Phone') }}
            {{ Form::text('MobilePhone', null,  ['class' => 'form-control required', 'placeholder' => 'Enter Mobile PhoneNumber', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('SpouseSurname','Spouse Surname') }}
        {{ Form::text('SpouseSurname', $staff->SpouseSurname,  ['class' => 'form-control', 'placeholder' => 'First name']) }}
        {{-- <input type="text" value="{{ $staff->FullName }}" class="form-control" readonly> --}}
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('SpouseOthername','Spouse Othername') }}
        {{ Form::text('SpouseOthername', $staff->SpouseOthername,  ['class' => 'form-control', 'placeholder' => 'Middle name']) }}
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('WorkPhone','Work Phone Number') }}
            {{ Form::text('WorkPhone', null,  ['class' => 'form-control', 'placeholder' => 'Enter Work Phone Number']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('ReligionID','Religion') }}
             {{ Form::select('ReligionID', [ 0 =>  'Select your religion'] + $religions->pluck('Religion', 'ReligionRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose Religion", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('MaritalStatusID','Marital Status') }}
            {{ Form::select('MaritalStatusID', [ 0 =>  'Marital Status'] + $status->pluck('MaritalStatus', 'MaritalStatusRef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose your Marital Status", 'data-init-plugin' => "select2", 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="">
          {{ Form::label('DateOfMarriage','Date Of Marriage', ['class' => 'form-label']) }}
          <div class="input-group date dp">
            {{ Form::text('DateOfMarriage', null, ['class' => 'form-control', 'placeholder' => 'Date of Marriage']) }}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('NoofChildren','No of Children') }}
            {{ Form::number('NoofChildren', null,  ['class' => 'form-control', 'placeholder' => 'Enter No of Children']) }}
        </div>
    </div>

    {{-- <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('TownCity','Town / City') }}
            {{ Form::text('TownCity', null,  ['class' => 'form-control', 'placeholder' => 'Enter Town']) }}
        </div>
    </div> --}}
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('LocationID','Office Location') }}
            {{ Form::select('LocationID', [ '' =>  'Select Location'] + $locations->pluck('Location', 'LocationRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Office Location", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('StateOfMarriage','State of Marriage') }}
            {{ Form::select('StateOfMarriage', [ '' =>  'Select State'] + $states->pluck('State', 'StateRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose State of Marriage", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    {{-- <div class="col-sm-4">
        <div class="form-group">
          {{ Form::label('LGAID','Local Government') }}
          {{ Form::select('LGAID', [ '' =>  'Select State'] + $lgas->pluck('LGA', 'LGARef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Local Government", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('CountryID','Country') }}
            {{ Form::select('CountryID', [ '' =>  'Select Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Country", 'data-init-plugin' => "select2"]) }}
        </div>
    </div> --}}
</div>

    {{-- <div class="clearfix"></div> --}}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('AddressLine1','Residential Address', ['class' => 'req']) }}
            {{ Form::textarea('AddressLine1', null,  ['class' => 'form-control required', 'rows'=>'2', 'placeholder' => 'Enter Address1', 'required']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('AddressLine2','Address2') }}
            {{ Form::textarea('AddressLine2', null,  ['class' => 'form-control ', 'rows'=>'2', 'placeholder' => 'Enter Address2']) }}
        </div>
    </div>
</div>

<div class="card-section p-l-5">References</div>
    @foreach($refs as $key=>$value)
        <div class="row ref-row">
        <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Name','Ref. Name') }}
            {{ Form::text('RefName[]', $value->Name,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Name', 'disabled']) }}
          </div>
        </div>

         <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefRelationship','Relationship') }}
            {{ Form::text('RefRelationship[]', $value->Relationship,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Relationship', 'disabled']) }}
          </div>
        </div>

         <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefOccupation','Occupation') }}
            {{ Form::text('RefOccupation[]', $value->Occupation,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Occupation', 'disabled']) }}
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefPhone','Phone') }}
            {{ Form::text('RefPhone[]', $value->Phone,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Phone', 'disabled']) }}
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefEmail','Email') }}
            {{ Form::email('RefEmail[]', $value->Email,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Email', 'disabled']) }}
          </div>
        </div>


    </div> <hr>
    @endforeach
    <div class="row ref-row">
        <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Name','Ref. Name') }}
            {{ Form::text('RefName[]', null,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Name']) }}
          </div>
        </div>

         <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefRelationship','Relationship') }}
            {{ Form::text('RefRelationship[]', null,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Relationship']) }}
          </div>
        </div>

         <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefOccupation','Occupation') }}
            {{ Form::text('RefOccupation[]', null,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Occupation']) }}
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefPhone','Phone') }}
            {{ Form::text('RefPhone[]', null,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Phone']) }}
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('RefEmail','Email') }}
            {{ Form::email('RefEmail[]', null,  ['class' => 'form-control', 'placeholder' => 'Enter Ref. Email']) }}
          </div>
        </div>


    </div>

    <div class="form-group" style="margin-left: 7px">
        <button id="add-more-refs" type="button" class="btn btn-complete">&plus; Add More</button>
        {{-- <button id="add-more-refs" type="button" class="btn btn-danger">&minus; Remove</button> --}}
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
            {{ Form::text('NextofKIN', null,  ['class' => 'form-control required', 'placeholder' => 'Enter Name of Next of KIN', 'required']) }}
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
            {{ Form::label('BeneficiaryRelationship','Beneficiary Relationship') }}
            {{ Form::text('BeneficiaryRelationship', null,  ['class' => 'form-control required', 'placeholder' => 'Enter Beneficiary Relationship', 'required']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('Beneficiary_Phone','Beneficiary Phone Number') }}
            {{ Form::text('Beneficiary_Phone', null,  ['class' => 'form-control required', 'placeholder' => 'Enter Beneficiary Phone Number', 'required']) }}
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

    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('UniversityAttended1','University Attended (1st Degree)') }}
        {{ Form::text('UniversityAttended1', null,  ['class' => 'form-control', 'placeholder' => 'Enter University Attended']) }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('UniversityAttended2','University Attended (2nd Degree)') }}
        {{ Form::text('UniversityAttended2', null,  ['class' => 'form-control', 'placeholder' => 'Enter University Attended']) }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('UniversityAttended3','University Attended (3rd Degree)') }}
        {{ Form::text('UniversityAttended3', null,  ['class' => 'form-control', 'placeholder' => 'Enter University Attended']) }}
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('ProfessionalQualification1','Professional Qualification (1st Degree)') }}
        {{ Form::text('ProfessionalQualification1', null,  ['class' => 'form-control', 'placeholder' => 'Enter Professional Qualification']) }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('ProfessionalQualification2','Professional Qualification (2nd Degree)') }}
        {{ Form::text('ProfessionalQualification2', null,  ['class' => 'form-control', 'placeholder' => 'Enter Professional Qualification']) }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('ProfessionalQualification3','Professional Qualification (3rd Degree)') }}
        {{ Form::text('ProfessionalQualification3', null,  ['class' => 'form-control', 'placeholder' => 'Enter Professional Qualification']) }}
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('NYSCYear','NYSC Year') }}
        {{ Form::text('NYSCYear', null,  ['class' => 'form-control', 'placeholder' => 'Enter NYSC Year']) }}
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('NYSCLocation','NYSC Location') }}
        {{ Form::text('NYSCLocation', null,  ['class' => 'form-control', 'placeholder' => 'Enter NYSC Location']) }}
      </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
          {{ Form::label('MSWord','MSWord Proficiency') }}
          {{ Form::select('MSWord', [ '' =>  'Select State'] + ['1'=>'Basic', '2'=>'Intermediate', '3'=>'Advance'],null, ['class'=> "full-width",'data-placeholder' => "MSWord Proficiency", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
          {{ Form::label('MSExcel','MSExcel Proficiency') }}
          {{ Form::select('MSExcel', [ '' =>  'Select State'] + ['1'=>'Basic', '2'=>'Intermediate', '3'=>'Advance'],null, ['class'=> "full-width",'data-placeholder' => "MSExcel Proficiency", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
          {{ Form::label('MSAccess','MSAccess Proficiency') }}
          {{ Form::select('MSAccess', [ '' =>  'Select State'] + ['1'=>'Basic', '2'=>'Intermediate', '3'=>'Advance'],null, ['class'=> "full-width",'data-placeholder' => "MSAccess Proficiency", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
          {{ Form::label('PowerPoint','PowerPoint Proficiency') }}
          {{ Form::select('PowerPoint', [ '' =>  'Select State'] + ['1'=>'Basic', '2'=>'Intermediate', '3'=>'Advance'],null, ['class'=> "full-width",'data-placeholder' => "PowerPoint Proficiency", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>

    <div class="clearfix"></div>

    {{-- declaration --}}
    {{-- <div class="col-sm-12">
        <div class="form-group">
            {{ Form::label('') }}
        </div>
    </div> --}}

    <div class="clearfix"></div>

    <div class="card-section p-l-5">Declaration</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
             <label for="Declaration" class="">
              {{ Form::checkbox('Declaration', null , $staff->Declaration, ['class' => 'checkbox']) }}
              I {{ $staff->FullName }} hereby certify that all the information supplied by me in this form are correct and true
             </label>
            </div>
        </div>
    </div>


    @if($user->hasRole('admin'))

    </div>
    <div class="row">

    <div class="card-section p-l-5">Bank Details</div>
    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('BankID','Choose Bank') }}
        {{ Form::select('BankID', [ 0 =>  'Select a Bank'] + $banks->pluck('BankName', 'BankRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Bank", 'data-init-plugin' => "select2", 'required']) }}
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('BankAcctNumber','Bank Account Number') }}
        {{ Form::text('BankAcctNumber', null,  ['class' => 'form-control required', 'placeholder' => 'Enter Bank Account Number', 'required']) }}
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="card-section p-l-5">PFA Details</div>
    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('PFAID','Choose PFA') }}
        {{ Form::select('PFAID', [ 0 =>  'Select a PFA'] + $pfa->pluck('PFA', 'PFARef')->toArray(),null, ['class'=> "full-width required",'data-placeholder' => "Choose PFA", 'data-init-plugin' => "select2", 'required']) }}
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('PensionRSANumber','PFA RSA Number') }}
        {{ Form::text('PensionRSANumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter PFA RSA Number']) }}
      </div>
    </div>



    <div class="clearfix"></div>

    <div class="card-section p-l-5">Payroll Details</div>

    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('LifeAssurance','Annual Life Assurance') }}
        {{ Form::text('LifeAssurance', null,  ['class' => 'form-control', 'placeholder' => 'Enter Annual Life Assurance Amount','required']) }}
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        {{ Form::label('PayrollGroupID','Payroll Group') }}
        {{ Form::select('PayrollGroupID', [ 0 =>  'Select a payroll group'] + $payroll_groups->pluck('GroupDescription', 'GroupRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose Religion", 'data-init-plugin' => "select2"]) }}
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        {{ Form::label('LeaveDays','Number of Leave Days') }}
        {{ Form::number('LeaveDays', null,  ['class' => 'form-control', 'placeholder' => 'Enter Number of Leave Days']) }}
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
          startDate: '1920-01-01',
          endDate: '{{ date('Y-m-d') }}',

      };
      $('.dp').datepicker(options);
  });
  </script>

  <script>
    $(document).ready(function(){

      $('select[name="DepartmentID[]"]').val('{{$staff->DepartmentID}}'.split(",")).trigger('change');

      // refs
      var ref_html = $(".ref-row")[0].innerHTML;
      $("#add-more-refs").click(function(e) {
          e.preventDefault();
          $('.ref-row').append('<div class="clearfix"></div><hr>').append(ref_html);
      });

    });
  </script>
@endpush
