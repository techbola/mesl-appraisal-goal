<div class="row">
	
	<div class="col-md-6">
    <div class="form-group">
      {{ Form::label('course_id', 'Select Course' ) }}
      <select name="course_id" onchange="get_duration()" id="send_duration" class="full-width" data-init-plugin="select2">
      	<option value=" ">Select Course</option>
      	@foreach($course_names as $course_name)
      		<option value="{{ $course_name->course_ref }}">{{ $course_name->courses_name }}</option>
      	@endforeach
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('duration', 'Course Duration' ) }}
      {{ Form::text('duration', null, ['class' => 'form-control', 'id'=>'insert_duration', 'placeholder' => 'Course Duration', 'required', 'readonly']) }}
    </div>
  </div><div class="clearfix"></div>

   <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('start_date','Start Date') }}
            <div class="input-group date dp">
                {{ Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('end_date','Start Date') }}
            <div class="input-group date dp">
                {{ Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'date Date']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
    <div class="form-group">
      {{ Form::label('priority', 'Priority Level' ) }}
      <select name="priority" class="full-width" data-init-plugin="select2">
      	<option value=" ">Select Course</option>
      	<option value="High">High</option>
      	<option value="Normal">Normal</option>
      	<option value="Low">Low</option>
      </select>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('staff_id', 'Select Course Participants' ) }}
      <select name="staff_id[]" class="full-width" data-init-plugin="select2" multiple>
      	<option value=" ">Select participants</option>
      	@foreach($users as $user)
      		<option value="{{ $user->id }}">{{ $user->Fullname }}</option>
      	@endforeach
      </select>
    </div>
  </div>

  <button type="submit" id="submit_new_batch" class="btn btn-info btn-form pull-right" data-dismiss="modal">Create New Batch</button>

</div>