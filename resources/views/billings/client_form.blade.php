<div class="row">

  
  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
               {{ Form::label('Name' ) }}
               {{ Form::text('Customer', null, ['class' => 'form-control', 'placeholder' => 'Client Name', 'required']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
               {{ Form::label('Phone' ) }}
                   {{ Form::text('Phone', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) }}
           </div>
      </div>
  </div>

   <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
               {{ Form::label('Phone2', 'Phone 2' ) }}
                   {{ Form::text('Phone2', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
             {{ Form::label('Email' ) }}
             {{ Form::text('Email', null, ['class' => 'form-control', 'placeholder' => 'Input Email Address']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
       <div class="form-group">
           <div class="controls">
             {{ Form::label('Email2', 'Other Emails' ) }}
             {{ Form::text('Email2', null, ['class' => 'form-control', 'placeholder' => 'Input Email Addresses']) }}
           </div>
      </div>
  </div>

  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('TitleID', 'Title') }}
       {{ Form::select('TitleID', ['' => 'Select Title'] + $titles->pluck('Title', 'TitleRef')->toArray(), null, ['class'=>'form-control select2', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('GenderID', 'Gender') }}
       {{ Form::select('GenderID', ['' => 'Select Gender'] + $genders->pluck('Gender', 'GenderRef')->toArray(), null, ['class'=>'form-control select2', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('NationalityID', 'Nationality') }}
       {{ Form::select('NationalityID', ['' => 'Select Nationality'] + $nationalities->pluck('Nationality', 'NationalityRef')->toArray(), null, ['class'=>'form-control select2', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  
  <div class="col-sm-4">
     <div class="form-group">
       {{ Form::label('AccountMgrID', 'Account Manager') }}
       {{ Form::select('AccountMgrID', ['' => 'Select Account Manager'] + $AccountMgr->pluck('AccountManager', 'AccountMgrRef')->toArray(), null, ['class'=>'form-control select2', 'data-init-plugin'=>'select2']) }}
    </div>
  </div>
  
  <div class="col-sm-4">
      {{ Form::label('EnrollmentDate', 'Enrollment Date', ['class'=>'form-label']) }}
      <div class="input-group date dp">
        {{ Form::text('EnrollmentDate', null, ['class' => 'form-control', 'placeholder' => 'Enrollment Date']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
  </div>
  
  <div class="col-sm-4">
    <div class="form-group">
      {{ Form::label('Address', 'Address') }}
      {{ Form::text('Address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address']) }}
    </div>
  </div>
  <div class="col-sm-4">
    {{ Form::label('DateOfBirth', 'Date Of Birth', ['class'=>'form-label']) }}
    <div class="input-group date dp">
      {{ Form::text('DateOfBirth', null, ['class' => 'form-control', 'placeholder' => 'Date Of Birth']) }}
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </div>
  

</div>
<input type="submit" class="btn btn-info btn-cons pull-right" value="Submit">
