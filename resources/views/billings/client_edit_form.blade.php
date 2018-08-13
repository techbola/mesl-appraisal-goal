<div class="row">

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
             {{ Form::label('FileNo' ) }}
             {{ Form::text('FileNo', null, ['class' => 'form-control','id'=>'edit_FileNo', 'placeholder' => 'Enter File No', 'required']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
               {{ Form::label('Name' ) }}
               {{ Form::text('Customer', null, ['class' => 'form-control', 'id'=>'edit_Customer', 'placeholder' => 'Client Name', 'required']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
    <div class="form-group">
       {{ Form::label('HouseType', 'House Type' ) }}
       {{ Form::select('HouseType', ['' => 'Select House Type'] + $housetypes->pluck('HouseType', 'HouseTypeRef')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_HouseType', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
         {{ Form::label('BlockAllocation' ) }}
         {{ Form::text('BlockAllocation', null, ['class' => 'form-control', 'id'=>'edit_BlockAllocation', 'placeholder' => 'Input Block Allocation', 'required']) }}
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
               {{ Form::label('UnitAllocation' ) }}
                   {{ Form::text('UnitAllocation', null, ['class' => 'form-control', 'id'=>'edit_UnitAllocation', 'placeholder' => 'Input Unit Allocation', 'required']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
               {{ Form::label('Phone' ) }}
                   {{ Form::text('Phone', null, ['class' => 'form-control', 'id'=>'edit_Phone', 'placeholder' => 'Phone Number', 'required']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
             {{ Form::label('Email' ) }}
             {{ Form::text('Email', null, ['class' => 'form-control', 'id'=>'edit_Email', 'placeholder' => 'Input Email Address']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('TitleID', 'Title') }}
       {{ Form::select('TitleID', ['' => 'Select Title'] + $titles->pluck('Title', 'TitleRef')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_TitleID', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('GenderID', 'Gender') }}
       {{ Form::select('GenderID', ['' => 'Select Gender'] + $genders->pluck('Gender', 'GenderRef')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_GenderID', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('NationalityID', 'Nationality') }}
       {{ Form::select('NationalityID', ['' => 'Select Nationality'] + $nationalities->pluck('Nationality', 'NationalityRef')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_NationalityID', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('MaritalStatusID', 'Marital Status') }}
       {{ Form::select('MaritalStatusID', ['' => 'Select Marital Status'] + $maritalstatuses->pluck('MaritalStatus', 'MaritalStatusRef')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_MaritalStatusID', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('AccountMgrID', 'Account Manager') }}
       {{ Form::select('AccountMgrID', ['' => 'Select Account Manager'] + $staff->pluck('FullName', 'UserID')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_AccountMgrID', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('PaymentPlanID', 'Payment Plan') }}
       {{ Form::select('PaymentPlanID', ['' => 'Select Payment Plan'] + $paymentplans->pluck('PaymentPlan', 'PaymentPlanRef')->toArray(), null, ['class'=>'form-control select2', 'id'=>'edit_PaymentPlanID', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
      {{ Form::label('EnrollmentDate', 'Enrollment Date', ['class'=>'form-label']) }}
      <div class="input-group date dp">
        {{ Form::text('EnrollmentDate', null, ['class' => 'form-control', 'id'=>'edit_EnrollmentDate', 'placeholder' => 'Enrollment Date']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('PropertyCost', 'Property Cost') }}
       {{ Form::text('PropertyCost', null, ['class' => 'form-control smartinput', 'id'=>'edit_PropertyCost', 'placeholder' => 'Enter Property Cost']) }}
    </div>
  </div><div class="clearfix"></div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('AmountPaid', 'Amount Paid') }}
       {{ Form::text('AmountPaid', null, ['class' => 'form-control smartinput', 'id'=>'edit_AmountPaid', 'placeholder' => 'Enter Amount Paid']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('AmountOutstanding', 'Amount Outstanding') }}
       {{ Form::text('AmountOutstanding', null, ['class' => 'form-control smartinput', 'id'=>'edit_AmountOutstanding', 'placeholder' => 'Enter Amount Outstanding']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('PropertyReference', 'Property Reference') }}
       {{ Form::text('PropertyReference', null, ['class' => 'form-control', 'id'=>'edit_PropertyReference', 'placeholder' => 'Enter Property Reference']) }}
    </div>
  </div>



  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('DeliveryPeriod', 'Delivery Period') }}
      {{ Form::text('DeliveryPeriod', null, ['class' => 'form-control', 'id'=>'edit_DeliveryPeriod', 'placeholder' => 'Enter Delivery Period']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('HouseUnitStatus', 'House Unit Status') }}
      {{ Form::text('HouseUnitStatus', null, ['class' => 'form-control', 'id'=>'edit_HouseUnitStatus', 'placeholder' => 'Enter House Unit Status']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('DefaultPeriod', 'Default Period') }}
      {{ Form::text('DefaultPeriod', null, ['class' => 'form-control',  'id'=>'edit_DefaultPeriod','placeholder' => 'Enter Default Period']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('Address', 'Address') }}
      {{ Form::text('Address', null, ['class' => 'form-control', 'id'=>'edit_Address', 'placeholder' => 'Enter Address']) }}
    </div>
  </div>
  <div class="col-sm-4">
    {{ Form::label('DateOfBirth', 'Date Of Birth', ['class'=>'form-label']) }}
    <div class="input-group date dp">
      {{ Form::text('DateOfBirth', null, ['class' => 'form-control', 'id'=>'edit_DateOfBirth', 'placeholder' => 'Date Of Birth']) }}
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('NextOfKIN', 'Next Of KIN') }}
      {{ Form::text('NextOfKIN', null, ['class' => 'form-control', 'id'=>'edit_NextOfKIN', 'placeholder' => 'Enter Next Of KIN']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('Employer', 'Employer') }}
      {{ Form::text('Employer', null, ['class' => 'form-control', 'id'=>'edit_Employer', 'placeholder' => 'Enter Employer']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('Industry', 'Industry') }}
      {{ Form::text('Industry', null, ['class' => 'form-control', 'id'=>'edit_Industry', 'placeholder' => 'Enter Industry']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('ContactSource', 'Contact Source') }}
      {{ Form::text('ContactSource', null, ['class' => 'form-control', 'id'=>'edit_ContactSource', 'placeholder' => 'Enter Contact Source']) }}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('Remarks', 'Remarks') }}
      {{ Form::text('Remarks', null, ['class' => 'form-control', 'id'=>'edit_Remarks', 'placeholder' => 'Enter Remarks']) }}
    </div>
  </div>
  <input type="hidden" name="CustomerRef" id="edit_CustomerRef">

</div>
<input type="submit" id="submit_edited_client_data" data-toggle="modal" class="btn btn-info btn-cons pull-right" value="Submit">


@push('scripts')
  <script>
      $('#submit_edited_client_data').click(function(event) {
        $.post('/submit_edited_client_data', $('#xyz').serialize(), function(data, status) {
          if (status == 'success') 
          {
          }
        });
      });
  </script>
@endpush
