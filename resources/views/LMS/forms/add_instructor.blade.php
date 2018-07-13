<div class="row">

	<div class="col-md-6">
    <div class="form-group">
      {{ Form::label('instructor_type', 'Instructor Type' ) }}
      <select name="instructor_type" class="full-width" data-init-plugin="select2" id="instructor_type" onchange="find_instructor()">
      	<option value=" ">Select Instructor Type</option>
      	<option value="1">Internal Instructor</option>
      	<option value="2">External Instructor</option>
      </select>
    </div>
  </div>

  <div class="col-md-6" id='internal'>
    <div class="form-group">
      {{ Form::label('inst', 'Instructor Name' ) }}
      {{ Form::text('inst', null, ['class' => 'form-control', 'id'=>'typed', 'onblur'=>'typed_name()', 'placeholder' => 'Enter Instructor Name', 'required']) }}
    </div>
  </div>

  <div class="col-md-6 hide" id="staff_name">
    <div class="form-group">
      {{ Form::label('inst', 'Instructor Name' ) }}
      <select name="inst" id="user_name" onchange="users_details()" class="full-width" data-init-plugin="select2">
      	<option value=" ">Select Staff Name</option>
      	@foreach($users as $user)
      		<option value="{{ $user->id }}">{{ $user->Fullname }}</option>
      	@endforeach
      </select>
    </div>
  </div><div class="clearfix"></div>

  <div class="col-md-4">
    <div class="form-group">
      {{ Form::label('email', 'Instructor Email' ) }}
      {{ Form::text('email', null, ['class' => 'form-control', 'id'=>'email', 'placeholder' => 'Enter Instructor Email', 'required']) }}
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      {{ Form::label('phone', 'Instructor Phone Number' ) }}
      {{ Form::text('phone', null, ['class' => 'form-control', 'id'=>'MobilePhone', 'placeholder' => 'Enter Instructor Phone Number', 'required']) }}
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      {{ Form::label('company_name', 'Company Name' ) }}
      {{ Form::text('company_name', null, ['class' => 'form-control', 'id'=>'company', 'placeholder' => 'Enter Company Name', 'required']) }}
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('company_address', 'Company Address' ) }}
      {{ Form::text('company_address', null, ['class' => 'form-control', 'id'=>'company_address', 'placeholder' => 'Enter Company Address', 'required']) }}
    </div>
  </div>
  <input name="instructor_name" type="hidden" id="get_instructor_name"> 
  <button type="submit" id="submit_new_instructor" class="btn btn-info btn-form pull-right" data-dismiss="modal">Add New Course Instructor</button>


</div>