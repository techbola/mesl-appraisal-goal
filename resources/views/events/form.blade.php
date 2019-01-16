<div class="row">
  <div class="col-md-12">
    {{-- <div class="form-group">
      <label>Select Recipient Department</label>
      <select class="form-control select2" name="DepartmentID" data-init-plugin="select2" required>
        <option value="">Select Department</option>
        @foreach ($departments as $dept)
          <option value="{{ $dept->DepartmentRef }}">{{ $dept->Department }}</option>
        @endforeach
      </select>
    </div> --}}

    <div class="form-group">
      {{ Form::label('DepartmentID', 'Select Recipient Department') }}
      {{-- <a class="pull-right toggle_loc toggle_icon" onclick="new_loc()"> <i class="fa fa-plus-circle text-success"></i> </a> --}}
      <select class="form-control select2" name="DepartmentID" data-init-plugin="select2" required>
        <option value=""> -- Select Department --</option>
        @foreach($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('Event', 'Event Title' ) }}
      {{-- <input type="text" class="form-control" name="Event" placeholder="Enter event title" required> --}}
      {{ Form::text('Event', null, ['class' => 'form-control', 'placeholder' => 'Enter event title', 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('StartDate', 'Start Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('EndDate', 'End Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('StartTime', 'Start Time' ) }}
      <div class="input-group bootstrap-timepicker">
        {{ Form::text('StartTime', $StartTime, ['class' => 'form-control timepicker', 'placeholder' => 'Start Time']) }}
        <span class="input-group-addon"><i class="pg-clock"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('EndTime', 'End Time' ) }}
      <div class="input-group bootstrap-timepicker">
        {{ Form::text('EndTime', $EndTime, ['class' => 'form-control timepicker', 'placeholder' => 'End Time']) }}
        <span class="input-group-addon"><i class="pg-clock"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('Description', 'Description' ) }}
      {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Enter event description', 'rows' => '4']) }}
    </div>
  </div>



</div>
<button type="submit" class="btn btn-info btn-form">Submit</button>
