<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Project Title</label>
      {{-- <input type="text" class="form-control" name="Project" placeholder="Project" required> --}}
      {{ Form::text('Project', null, ['class' => 'form-control', 'placeholder' => 'Project Title', 'required']) }}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Supervisor') }}
      {{ Form::select('SupervisorID', [''=>'Select Supervisor'] + $supervisors->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Supervisor", 'data-init-plugin' => "select2", 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('StartDate', 'Start Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('StartDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
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

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('Customer') }}
      {{ Form::select('CustomerID', [''=>'Select Customer'] + $customers->pluck('Customer', 'CustomerRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Customer", 'data-init-plugin' => "select2", 'required']) }}
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('Description', 'Description / Project Details' ) }}
      {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Enter project detals and instructions.', 'rows' => '4']) }}
    </div>
  </div>

</div>
